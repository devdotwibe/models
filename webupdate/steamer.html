<!DOCTYPE html>
<html>
<head>
    <title>Broadcaster</title>
</head>
<body>
    <h2>Broadcaster</h2>
    <video id="local" autoplay muted playsinline></video>
    <button onclick="startBroadcast()">Start Broadcast</button>

    <script>
        const socket = new WebSocket("wss://models.staging3.dotwibe.com/webrtcsocket");
        const peers = {}; // viewerId -> RTCPeerConnection
        let localStream = null;

        async function startBroadcast() {
            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            document.getElementById('local').srcObject = localStream;
        }

        function createPeerConnection(viewerId) {
            const peer = new RTCPeerConnection({
                iceServers: [
                    { urls: "stun:stun.l.google.com:19302" },
                    {
                        urls: "turn:openrelay.metered.ca:80",
                        username: "openrelayproject",
                        credential: "openrelayproject"
                    }
                ]
            });

            localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

            peer.onicecandidate = e => {
                if (e.candidate) {
                    socket.send(JSON.stringify({
                        event: "stream-candidate",
                        target: viewerId,
                        data: e.candidate
                    }));
                }
            };

            peers[viewerId] = peer;
            return peer;
        }

        socket.onmessage = async ({ data }) => {
            const msg = JSON.parse(data);

            if (msg.event === "request-offer") {
                const viewerId = msg.from;
                const peer = createPeerConnection(viewerId);
                const offer = await peer.createOffer();
                await peer.setLocalDescription(offer);
                socket.send(JSON.stringify({
                    event: "stream-offer",
                    target: viewerId,
                    data: offer
                }));
            }

            if (msg.event === "view-answer") {
                const viewerId = msg.from;
                if (peers[viewerId]) {
                    await peers[viewerId].setRemoteDescription(new RTCSessionDescription(msg.data));
                }
            }

            if (msg.event === "view-candidate") {
                const viewerId = msg.from;
                if (peers[viewerId]) {
                    await peers[viewerId].addIceCandidate(new RTCIceCandidate(msg.data));
                }
            }
        };
    </script>
</body>
</html>
