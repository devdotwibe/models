<!DOCTYPE html>
<html>
<head>
  <title>WebRTC Live Broadcast</title>
</head>
<body>
  <h2>WebRTC Broadcast</h2>
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
    let pcs = {}; // Streamer: viewerId -> RTCPeerConnection
    let pc;       // Viewer: single connection
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

        sendEvent("join", {
          roomId,
          role,
          viewerId
        });

        if (role === 'streamer') startBroadcast();
        else startViewer();
      };

      socket.onmessage = async (event) => {
        const msg = JSON.parse(event.data);
        if (!msg.event || !msg.data) return;

        const { event: evt, data } = msg;

        // Viewers get offer
        if (role === 'viewer' && evt === 'offer') {
          console.log("📩 Viewer received offer");
          await pc.setRemoteDescription(new RTCSessionDescription(data.payload));
          const answer = await pc.createAnswer();
          await pc.setLocalDescription(answer);
          sendEvent("answer", {
            roomId,
            viewerId,
            payload: answer
          });
        }

        // Streamer gets answer from viewer
        if (role === 'streamer' && evt === 'answer') {
          const vId = data.viewerId;
          if (pcs[vId]) {
            console.log("📩 Streamer received answer from viewer:", vId);
            await pcs[vId].setRemoteDescription(new RTCSessionDescription(data.payload));
          } else {
            console.warn("⚠️ No peer connection for viewerId:", vId);
          }
        }

        // ICE candidates
        if (evt === 'ice') {
          const { viewerId: vId, payload } = data;
          try {
            if (role === 'viewer' && pc) {
              await pc.addIceCandidate(new RTCIceCandidate(payload));
              console.log("✅ Viewer added ICE candidate");
            } else if (role === 'streamer' && pcs[vId]) {
              await pcs[vId].addIceCandidate(new RTCIceCandidate(payload));
              console.log("✅ Streamer added ICE candidate for viewer:", vId);
            }
          } catch (err) {
            console.error("⚠️ ICE candidate error:", err);
          }
        }

        // Viewer requests offer
        if (role === 'streamer' && evt === 'request-offer') {
          console.log("📨 Viewer requested offer:", data.viewerId);
          createPeerConnectionForViewer(data.viewerId);
        }
      };

      socket.onerror = (err) => {
        console.error("❌ WebSocket error:", err);
      };
    }

    function sendEvent(event, data) {
      socket.send(JSON.stringify({ event, data }));
    }

    // STREAMER SIDE
    async function startBroadcast() {
      try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        document.getElementById('localVideo').srcObject = localStream;
      } catch (err) {
        console.error("🎥 Error accessing media:", err);
      }
    }

    async function createPeerConnectionForViewer(vId) {
      const peer = new RTCPeerConnection(config);
      pcs[vId] = peer;

      localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

      peer.onicecandidate = (e) => {
        if (e.candidate) {
          sendEvent("ice", {
            roomId,
            viewerId: vId,
            payload: e.candidate
          });
        }
      };

      const offer = await peer.createOffer();
      await peer.setLocalDescription(offer);

      sendEvent("offer", {
        roomId,
        viewerId: vId,
        payload: offer
      });
    }

    // VIEWER SIDE
    async function startViewer() {
      document.getElementById('localVideo').style.display = 'none';

      pc = new RTCPeerConnection(config);

      pc.ontrack = (event) => {
        console.log("📺 Viewer received stream");
        document.getElementById('remoteVideo').srcObject = event.streams[0];
      };

      pc.onicecandidate = (e) => {
        if (e.candidate) {
          sendEvent("ice", {
            roomId,
            viewerId,
            payload: e.candidate
          });
        }
      };

      // Ask for offer
      sendEvent("request-offer", { roomId, viewerId });
    }
  </script>
</body>
</html>
