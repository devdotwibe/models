<!DOCTYPE html>
<html>
<head>
  <title>WebRTC Viewer</title>
</head>
<body>
  <h2>WebRTC Live Viewer</h2>
  <video id="remoteVideo" autoplay playsinline width="400" height="300" style="border:1px solid black;"></video>

  <script>
    const params = new URLSearchParams(window.location.search);
    const roomId = params.get('room_id');
    const role = 'viewer';
    const viewerId = Math.floor(Math.random() * 1000000);

    const config = {
      iceServers: [{ urls: 'stun:stun.l.google.com:19302' }]
    };

    let pc;
    let socket;

    window.onload = () => {
      if (!roomId) {
        alert("Missing room_id in URL");
        return;
      }

      initWebSocket();
    };

    function initWebSocket() {
      socket = new WebSocket("wss://models.staging3.dotwibe.com/webrtcsocket/");

      socket.onopen = () => {
        console.log("✅ WebSocket connected (viewer)");

        // Send join message
        socket.send(JSON.stringify({
          type: 'join',
          role,
          roomId,
          viewerId
        }));

        startViewer();
      };

     socket.onmessage = async (event) => {
        const msg = JSON.parse(event.data);

        if (msg.event === 'offer' && msg.data.viewerId === viewerId) {
          await pc.setRemoteDescription(new RTCSessionDescription(msg.data.payload));
          const answer = await pc.createAnswer();
          await pc.setLocalDescription(answer);
          sendMessage('answer', pc.localDescription);
        }

        if (msg.event === 'answer' && msg.data.viewerId === viewerId) {
          await pc.setRemoteDescription(new RTCSessionDescription(msg.data.payload));
        }

        if (msg.event === 'ice' && msg.data.viewerId === viewerId) {
          try {
            await pc.addIceCandidate(new RTCIceCandidate(msg.data.payload));
          } catch (err) {
            console.error("ICE add error:", err);
          }
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

    async function startViewer() {
      pc = new RTCPeerConnection(config);

      pc.ontrack = (event) => {
        const video = document.getElementById('remoteVideo');
        if (!video.srcObject) {
          video.srcObject = event.streams[0];
          console.log("✅ Stream received");
        }
      };

      pc.onicecandidate = (event) => {
        if (event.candidate) {
          sendMessage("ice", event.candidate);
        }
      };

      // Request offer from streamer
      sendMessage("request-offer", null);
    }
  </script>
</body>
</html>
