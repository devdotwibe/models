const localVideo = document.getElementById('localVideo');
const remoteVideo = document.getElementById('remoteVideo');
let localStream;
let peerConnection;
const config = {
  iceServers: [
        {
            urls: "stun:stun.l.google.com:19302"
        },
        {
            urls: "turn:209.182.232.170:3478",
            username: "USERNAME",
            credential: "PASSWORD"
        }
    ]

};

const username = prompt("Enter your name:");
const remoteUser = prompt("Enter remote user name to connect:");

async function init() {
  localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
  localVideo.srcObject = localStream;

  peerConnection = new RTCPeerConnection(config);

  localStream.getTracks().forEach(track => {
    peerConnection.addTrack(track, localStream);
  });

  peerConnection.onicecandidate = event => {
    if (event.candidate) {
      sendSignal({ type: 'ice', candidate: event.candidate });
    }
  };

  peerConnection.ontrack = event => {
    remoteVideo.srcObject = event.streams[0];
  };

  listenForSignals();

  // if initiator
  const offer = await peerConnection.createOffer();
  await peerConnection.setLocalDescription(offer);
  sendSignal({ type: 'offer', sdp: offer.sdp });
}
async function handleSignal(data) {
  if (data.type === 'offer') {
    if (!peerConnection.currentRemoteDescription) {
      await peerConnection.setRemoteDescription(new RTCSessionDescription({ type: 'offer', sdp: data.sdp }));
      const answer = await peerConnection.createAnswer();
      await peerConnection.setLocalDescription(answer);
      sendSignal({ type: 'answer', sdp: answer.sdp });
    }
  } else if (data.type === 'answer') {
    if (!peerConnection.currentRemoteDescription) {
      await peerConnection.setRemoteDescription(new RTCSessionDescription({ type: 'answer', sdp: data.sdp }));
    }
  } else if (data.type === 'ice') {
    if (data.candidate) {
      try {
        await peerConnection.addIceCandidate(data.candidate);
      } catch (e) {
        console.error('Error adding ICE candidate', e);
      }
    }
  }
}

// async function handleSignal(data) {
//   if (data.type === 'offer') {
//     await peerConnection.setRemoteDescription(new RTCSessionDescription({ type: 'offer', sdp: data.sdp }));
//     const answer = await peerConnection.createAnswer();
//     await peerConnection.setLocalDescription(answer);
//     sendSignal({ type: 'answer', sdp: answer.sdp });
//   } else if (data.type === 'answer') {
//     await peerConnection.setRemoteDescription(new RTCSessionDescription({ type: 'answer', sdp: data.sdp }));
//   } else if (data.type === 'ice') {
//     try {
//       await peerConnection.addIceCandidate(data.candidate);
//     } catch (e) {
//       console.error('Error adding received ice candidate', e);
//     }
//   }
// }

function sendSignal(data) {
  fetch('signaling.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `action=send&from=${username}&to=${remoteUser}&data=${encodeURIComponent(JSON.stringify(data))}`
  });
}
let unicheck={};
function listenForSignals() {
  setInterval(() => {
    fetch('signaling.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `action=get&to=${username}`
    })
    .then(res => res.json())
    .then(signals => {
      signals.forEach(signal => {
        const data = JSON.parse(signal.data);
        // if(!unicheck[`${signal.from}-*-${signal.to}-*-${data.type}`]){
        //     unicheck[`${signal.from}-*-${signal.to}`]=data;
            handleSignal(data);
        // }
      });
    });
  }, 1000);
}

init();
