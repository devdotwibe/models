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
    let pc;
    let socket;

    async function joinRoomViaAjax() {
      const res = await fetch('/api/join-room', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ room_id: roomId, role, viewer_id: viewerId })
      });

      const data = await res.json();
      console.log("Room joined via AJAX:", data);

      initWebSocket(); // Proceed to signaling
    }

    function initWebSocket() {
      socket = new WebSocket("wss://models.staging3.dotwibe.com/webrtcsocket/");

      socket.onopen = () => {
        console.log("✅ WebSocket connected");

        // Notify server through socket
        socket.send(JSON.stringify({
          event: 'join',
          data: { roomId, role, viewerId }
        }));

        if (role === 'streamer') startBroadcast();
        else if (role === 'viewer') startViewer();
      };

      socket.onmessage = async (event) => {
        const msg = JSON.parse(event.data);

        if (msg.event === 'offer' && role === 'viewer') {
          await pc.setRemoteDescription(new RTCSessionDescription(msg.data));
          const answer = await pc.createAnswer();
          await pc.setLocalDescription(answer);
          sendSocketMessage('answer', pc.localDescription);
        }

        if (msg.event === 'answer' && role === 'streamer') {
          await pc.setRemoteDescription(new RTCSessionDescription(msg.data));
        }

        if (msg.event === 'ice') {
          const candidate = new RTCIceCandidate(msg.data);
          try {
            await pc.addIceCandidate(candidate);
          } catch (e) {
            console.warn("ICE error:", e);
          }
        }

        if (msg.event === 'custom-message') {
          console.log("Custom Message Received:", msg.data);
        }
      };

      socket.onerror = (err) => {
        console.error("WebSocket error:", err);
      };
    }

    function sendSocketMessage(eventType, data) {
      socket.send(JSON.stringify({
        event: eventType,
        data: {
          roomId,
          viewerId,
          payload: data
        }
      }));
    }

    async function startBroadcast() {
      try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        document.getElementById('localVideo').srcObject = localStream;

        pc = new RTCPeerConnection(config);

        localStream.getTracks().forEach(track => pc.addTrack(track, localStream));

        pc.onicecandidate = (event) => {
          if (event.candidate) {
            sendSocketMessage('ice', event.candidate);
          }
        };

        const offer = await pc.createOffer();
        await pc.setLocalDescription(offer);
        sendSocketMessage('offer', offer);

      } catch (err) {
        console.error("Media access failed:", err);
      }
    }

    async function startViewer() {
      document.getElementById('localVideo').style.display = 'none';

      pc = new RTCPeerConnection(config);

      pc.ontrack = (event) => {
        document.getElementById('remoteVideo').srcObject = event.streams[0];
      };

      pc.onicecandidate = (event) => {
        if (event.candidate) {
          sendSocketMessage('ice', event.candidate);
        }
      };

      // Optionally request offer manually
      sendSocketMessage('request-offer', { viewerId });
    }

    // Auto-run
    if (!roomId || !role) {
      alert("Missing room_id or role");
    } else {
      joinRoomViaAjax(); // First AJAX join
    }
  </script>
</body>
</html>
