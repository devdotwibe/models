<!DOCTYPE html>
<html>

<head>
  <title>WebRTC Broadcast</title>
</head>

<body>
  <h2>WebRTC Live Broadcast</h2>
  <video id="localVideo" autoplay muted playsinline width="400" height="300" style="border:1px solid black;"></video>
  <video id="remoteVideo" autoplay muted playsinline width="400" height="300" style="border:1px solid black;"></video>

  <script>
    const params = new URLSearchParams(window.location.search);
    const roomId = params.get('room_id');
    const role = params.get('role'); // 'streamer' or 'viewer'
    const viewerId = Math.floor(Math.random() * 100000);

    const config = {
      iceServers: [
        { urls: "stun:stun.l.google.com:19302" },
        { urls: "stun:stun1.l.google.com:19302" },
        { urls: "stun:stun2.l.google.com:19302" }
      ]
    };

    let localStream;
    let pc;
    let socket;

    window.onload = () => {
      if (!roomId || !role) {
        alert("Missing room_id or role in URL");
        return;
      }

      initWebSocket();
    }

    function initWebSocket() {
      socket = new WebSocket("wss://models.staging3.dotwibe.com/webrtcsocket/");

      socket.onopen = () => {
        console.log("WebSocket connected");

        socket.send(JSON.stringify({
          type: 'join',
          roomId,
          role,
          viewerId
        }));

        if (role === 'streamer') startBroadcast();
        else if (role === 'viewer') startViewer();
      };

      socket.onmessage = async (event) => {
        const msg = JSON.parse(event.data);

        switch (msg.type) {
          case 'offer':
            if (role === 'viewer') {
              await pc.setRemoteDescription(new RTCSessionDescription(msg.data));
              const answer = await pc.createAnswer();
              await pc.setLocalDescription(answer);
              sendMessage('answer', answer);
            }
            break;

          case 'answer':
            if (role === 'streamer') {
              await pc.setRemoteDescription(new RTCSessionDescription(msg.data));
            }
            break;

          case 'ice':
            if (msg.data) {
              try {
                await pc.addIceCandidate(new RTCIceCandidate(msg.data));
              } catch (e) {
                console.warn('ICE add failed', e);
              }
            }
            break;
        }
      };

      socket.onerror = (err) => {
        console.error("WebSocket error:", err);
      };
    }

    function sendMessage(type, data) {
      socket.send(JSON.stringify({
        type,
        roomId,
        role,
        viewerId,
        data
      }));
    }

    // ---- STREAMER ----
    async function startBroadcast() {
      try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        document.getElementById('localVideo').srcObject = localStream;

        pc = new RTCPeerConnection(config);

        localStream.getTracks().forEach(track => pc.addTrack(track, localStream));

        pc.onicecandidate = e => {
          if (e.candidate) sendMessage("ice", e.candidate);
        };

        const offer = await pc.createOffer();
        await pc.setLocalDescription(offer);

        sendMessage("offer", offer);

      } catch (err) {
        console.error("Error accessing camera/mic:", err);
      }
    }

    // ---- VIEWER ----
    async function startViewer() {
      pc = new RTCPeerConnection(config);

      pc.ontrack = e => {
        const remoteVideo = document.getElementById('remoteVideo');
        if (!remoteVideo.srcObject) {
          remoteVideo.srcObject = e.streams[0];
        }
      };

      pc.onicecandidate = e => {
        if (e.candidate) sendMessage("ice", e.candidate);
      };
    }
  </script>
</body>

</html>
