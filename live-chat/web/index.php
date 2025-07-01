<!DOCTYPE html>
<html>
<head>
  <title>WebRTC Broadcast</title>
</head>
<body>
  <h2>WebRTC Live Broadcast</h2>
  <video id="localVideo" autoplay muted playsinline width="400" height="300" style="border:1px solid black;"></video>
  <video id="remoteVideo" autoplay playsinline width="400" height="300" style="border:1px solid black;"></video>

  <script>
    const params = new URLSearchParams(window.location.search);
    const roomId = params.get('room_id');
    const role = params.get('role'); // 'streamer' or 'viewer'
    const viewerId = Math.floor(Math.random() * 1000000);

    const config = {
      iceServers: [{ urls: 'stun:stun.l.google.com:19302' }]
    };

    let localStream;
    let pcs = {}; // streamer: viewerId => RTCPeerConnection
    let pc;       // viewer: single RTCPeerConnection
    let socket;

    window.onload = () => {
      if (!roomId || !role) {
        alert("Missing room_id or role in URL");
        return;
      }

      initWebSocket();
    };

    function initWebSocket() {
      socket = new WebSocket("wss://models.staging3.dotwibe.com/webrtcsocket/");

      socket.onopen = () => {
        console.log("✅ WebSocket connected");

        socket.send(JSON.stringify({
          type: 'join',
          roomId,
          role,
          viewerId
        }));

        if (role === 'streamer') {
          startBroadcast();
        } else if (role === 'viewer') {
          startViewer();
        }
      };

      socket.onmessage = async (event) => {
        const msg = JSON.parse(event.data);

        if (role === 'viewer' && msg.type === 'offer') {
          await pc.setRemoteDescription(new RTCSessionDescription(msg.data));
          const answer = await pc.createAnswer();
          await pc.setLocalDescription(answer);
          sendMessage("answer", answer);
        }

        if (role === 'streamer' && msg.type === 'answer') {
          const viewerId = msg.viewerId;
          if (pcs[viewerId]) {
            await pcs[viewerId].setRemoteDescription(new RTCSessionDescription(msg.data));
          }
        }

        if (msg.type === 'ice') {
          if (role === 'viewer' && pc) {
            try {
              await pc.addIceCandidate(new RTCIceCandidate(msg.data));
            } catch (err) {
              console.error("ICE error (viewer):", err);
            }
          } else if (role === 'streamer') {
            const viewerId = msg.viewerId;
            if (pcs[viewerId]) {
              try {
                await pcs[viewerId].addIceCandidate(new RTCIceCandidate(msg.data));
              } catch (err) {
                console.error("ICE error (streamer):", err);
              }
            }
          }
        }

        // NEW: viewer asks streamer to send offer
        if (role === 'streamer' && msg.type === 'request-offer') {
          createPeerConnectionForViewer(msg.viewerId);
        }
      };

      socket.onerror = (err) => {
        console.error("WebSocket error:", err);
      };
    }

    function sendMessage(type, data) {
      socket.send(JSON.stringify({
        type,
        role,
        roomId,
        viewerId,
        data
      }));
    }

    // STREAMER
    async function startBroadcast() {
      try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        document.getElementById('localVideo').srcObject = localStream;
      } catch (err) {
        console.error("Media error:", err);
      }
    }

    async function createPeerConnectionForViewer(vId) {
      const pc = new RTCPeerConnection(config);
      pcs[vId] = pc;

      localStream.getTracks().forEach(track => {
        pc.addTrack(track, localStream);
      });

      pc.onicecandidate = (event) => {
        if (event.candidate) {
          socket.send(JSON.stringify({
            type: "ice",
            role,
            roomId,
            viewerId: vId,
            data: event.candidate
          }));
        }
      };

      const offer = await pc.createOffer();
      await pc.setLocalDescription(offer);

      socket.send(JSON.stringify({
        type: "offer",
        role,
        roomId,
        viewerId: vId,
        data: offer
      }));
    }

    // VIEWER
    async function startViewer() {
      document.getElementById('localVideo').style.display = 'none'; // Hide local for viewer

      pc = new RTCPeerConnection(config);

      pc.ontrack = (event) => {
        document.getElementById('remoteVideo').srcObject = event.streams[0];
      };

      pc.onicecandidate = (event) => {
        if (event.candidate) {
          sendMessage("ice", event.candidate);
        }
      };

      // NEW: ask streamer to send offer
      sendMessage("request-offer", null);
    }
  </script>
</body>
</html>
