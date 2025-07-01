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

        sendEvent("join", {
          roomId,
          role,
          viewerId
        });

        if (role === 'streamer') {
          startBroadcast();
        } else if (role === 'viewer') {
          startViewer();
        }
      };

      socket.onmessage = async (event) => {
        const msg = JSON.parse(event.data);
        if (!msg.event || !msg.data) return;

        const { event: evt, data } = msg;

        // Viewer receives offer
        if (role === 'viewer' && evt === 'offer' && data.viewerId === viewerId) {
          console.log('📥 Offer received by viewer');
          await pc.setRemoteDescription(new RTCSessionDescription(data.payload));
          const answer = await pc.createAnswer();
          await pc.setLocalDescription(answer);
          sendEvent("answer", {
            roomId,
            viewerId,
            payload: answer
          });
        }

        // Streamer receives answer from viewer
        if (role === 'streamer' && evt === 'answer') {
          const vId = data.viewerId;
          if (pcs[vId]) {
            console.log('📥 Answer received by streamer');
            await pcs[vId].setRemoteDescription(new RTCSessionDescription(data.payload));
          }
        }

        // ICE candidates
        if (evt === 'ice') {
          const { viewerId: vId, payload } = data;
          try {
            if (role === 'viewer' && pc) {
              await pc.addIceCandidate(new RTCIceCandidate(payload));
            } else if (role === 'streamer' && pcs[vId]) {
              await pcs[vId].addIceCandidate(new RTCIceCandidate(payload));
            }
          } catch (err) {
            console.warn("⚠️ ICE error:", err);
          }
        }

        // Viewer requests offer
        if (role === 'streamer' && evt === 'request-offer') {
          createPeerConnectionForViewer(data.viewerId);
        }
      };

      socket.onerror = (err) => {
        console.error("WebSocket error:", err);
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
        console.error("🚫 Media error:", err);
      }
    }

    async function createPeerConnectionForViewer(vId) {
      const pc = new RTCPeerConnection(config);
      pcs[vId] = pc;

      // Add tracks to connection
      localStream.getTracks().forEach(track => {
        pc.addTrack(track, localStream);
      });

      pc.onicecandidate = (event) => {
        if (event.candidate) {
          sendEvent("ice", {
            roomId,
            viewerId: vId,
            payload: event.candidate
          });
        }
      };

      const offer = await pc.createOffer();
      await pc.setLocalDescription(offer);

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

      // When stream is received
      pc.ontrack = (event) => {
        const remoteVideo = document.getElementById('remoteVideo');
        if (!remoteVideo.srcObject) {
          console.log("📺 Remote stream received");
          remoteVideo.srcObject = event.streams[0];
        }
      };

      pc.onicecandidate = (event) => {
        if (event.candidate) {
          sendEvent("ice", {
            roomId,
            viewerId,
            payload: event.candidate
          });
        }
      };

      // Ask streamer to send an offer
      sendEvent("request-offer", { roomId, viewerId });
    }
  </script>
</body>
</html>
