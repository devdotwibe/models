<?php
// videosdk_meeting.php
include 'config.php'; // This file defines VIDEOSDK_TOKEN
?>
<!DOCTYPE html>
<html>
<head>
  <title>VideoSDK Meeting</title>
  <style>
    #join-screen, #grid-screen {
      padding: 10px;
      margin-bottom: 15px;
    }
    .video-frame {
      width: 300px;
      border: 1px solid #ccc;
      margin-right: 10px;
      display: inline-block;
    }
  </style>
  <script src="https://sdk.videosdk.live/js-sdk/0.1.6/videosdk.js"></script>
</head>
<body>

<div id="join-screen">
  <button id="createMeetingBtn">New Meeting</button>
  <br><br>
  <input type="text" id="meetingIdTxt" placeholder="Enter Meeting id" />
  <button id="joinBtn">Join Meeting</button>
</div>

<div id="textDiv"></div>

<div id="grid-screen" style="display:none;">
  <h3 id="meetingIdHeading"></h3>
  <button id="leaveBtn">Leave</button>
  <button id="toggleMicBtn">Toggle Mic</button>
  <button id="toggleWebCamBtn">Toggle WebCam</button>
  <div id="videoContainer"></div>
</div>

<script>
  console.log("Script loaded ✅");

  const TOKEN = '<?php echo VIDEOSDK_TOKEN; ?>';

  const joinButton = document.getElementById("joinBtn");
  const leaveButton = document.getElementById("leaveBtn");
  const toggleMicButton = document.getElementById("toggleMicBtn");
  const toggleWebCamButton = document.getElementById("toggleWebCamBtn");
  const createButton = document.getElementById("createMeetingBtn");
  const videoContainer = document.getElementById("videoContainer");
  const textDiv = document.getElementById("textDiv");

  let meeting = null;
  let meetingId = "";
  let isMicOn = true;
  let isWebCamOn = true;

  function createVideoElement(pId, name) {
    let videoFrame = document.createElement("div");
    videoFrame.setAttribute("id", `f-${pId}`);

    let videoElement = document.createElement("video");
    videoElement.classList.add("video-frame");
    videoElement.setAttribute("id", `v-${pId}`);
    videoElement.setAttribute("playsinline", true);
    videoElement.autoplay = true;
    videoFrame.appendChild(videoElement);

    let displayName = document.createElement("div");
    displayName.innerHTML = `Name: ${name}`;
    videoFrame.appendChild(displayName);

    return videoFrame;
  }

  function createAudioElement(pId) {
    let audioElement = document.createElement("audio");
    audioElement.setAttribute("autoPlay", "false");
    audioElement.setAttribute("playsInline", "true");
    audioElement.setAttribute("controls", "false");
    audioElement.setAttribute("id", `a-${pId}`);
    audioElement.style.display = "none";
    return audioElement;
  }

  function setTrack(stream, audioElement, participant, isLocal) {
    if (stream.kind === "video") {
      const mediaStream = new MediaStream();
      mediaStream.addTrack(stream.track);
      let videoElm = document.getElementById(`v-${participant.id}`);
      videoElm.srcObject = mediaStream;
      videoElm.play().catch(error => console.error("video play error", error));
      const videoFrame = document.getElementById(`f-${participant.id}`);
      videoFrame.style.display = "inline-block";
    } else if (stream.kind === "audio") {
      const mediaStream = new MediaStream();
      mediaStream.addTrack(stream.track);
      audioElement.srcObject = mediaStream;
      audioElement.play().catch(error => console.error("audio play error", error));
    }
  }

  function initializeMeeting() {
    if (!TOKEN) {
      alert("Token is not set!");
      return;
    }

    window.VideoSDK.config(TOKEN);

    meeting = window.VideoSDK.initMeeting({
      meetingId: meetingId,
      name: "Participant-" + Math.floor(Math.random() * 1000),
      micEnabled: true,
      webcamEnabled: true,
    });

    meeting.join();

    createLocalParticipant();

    meeting.localParticipant.on("stream-enabled", (stream) => {
      setTrack(stream, null, meeting.localParticipant, true);
    });

    meeting.on("meeting-joined", () => {
      textDiv.style.display = "none";
      document.getElementById("grid-screen").style.display = "block";
      document.getElementById("meetingIdHeading").textContent = `Meeting Id: ${meetingId}`;
    });

    meeting.on("meeting-left", () => {
      videoContainer.innerHTML = "";
      document.getElementById("grid-screen").style.display = "none";
      document.getElementById("join-screen").style.display = "block";
    });

    meeting.on("participant-joined", (participant) => {
      let videoElement = createVideoElement(participant.id, participant.displayName);
      let audioElement = createAudioElement(participant.id);

      participant.on("stream-enabled", (stream) => {
        setTrack(stream, audioElement, participant, false);
      });

      videoContainer.appendChild(videoElement);
      videoContainer.appendChild(audioElement);
    });

    meeting.on("participant-left", (participant) => {
      let vElement = document.getElementById(`f-${participant.id}`);
      if (vElement) vElement.remove();

      let aElement = document.getElementById(`a-${participant.id}`);
      if (aElement) aElement.remove();
    });
  }

  function createLocalParticipant() {
    let localParticipantElem = createVideoElement(meeting.localParticipant.id, meeting.localParticipant.displayName);
    videoContainer.appendChild(localParticipantElem);
  }

  // Join Meeting
  joinButton.addEventListener("click", async () => {
    meetingId = document.getElementById("meetingIdTxt").value.trim();
    if (!meetingId) {
      alert("Please enter a meeting ID to join.");
      return;
    }
    document.getElementById("join-screen").style.display = "none";
    textDiv.textContent = "Joining the meeting...";
    initializeMeeting();
  });

  // Create New Meeting
  createButton.addEventListener("click", async () => {
    console.log("Create meeting clicked");
    document.getElementById("join-screen").style.display = "none";
    textDiv.textContent = "Creating a new meeting... Please wait.";

    try {
      const response = await fetch("https://api.videosdk.live/v2/rooms", {
        method: "POST",
        headers: {
          Authorization: `Bearer ${TOKEN}`,   // ✅ FIXED
          "Content-Type": "application/json"
        },
      });

      if (!response.ok) {
        throw new Error(`API error: ${response.status}`);
      }

      const data = await response.json();
      console.log("Meeting created:", data);
      meetingId = data.roomId;
      initializeMeeting();
    } catch (error) {
      alert("Error creating meeting: " + error.message);
      document.getElementById("join-screen").style.display = "block";
      textDiv.textContent = "";
    }
  });

  // Leave Meeting
  leaveButton.addEventListener("click", () => {
    meeting?.leave();
  });

  // Toggle Mic
  toggleMicButton.addEventListener("click", () => {
    if (isMicOn) {
      meeting?.muteMic();
    } else {
      meeting?.unmuteMic();
    }
    isMicOn = !isMicOn;
  });

  // Toggle Webcam
  toggleWebCamButton.addEventListener("click", () => {
    if (isWebCamOn) {
      meeting?.disableWebcam();
      const localVideoFrame = document.getElementById(`f-${meeting.localParticipant.id}`);
      if(localVideoFrame) localVideoFrame.style.display = "none";
    } else {
      meeting?.enableWebcam();
      const localVideoFrame = document.getElementById(`f-${meeting.localParticipant.id}`);
      if(localVideoFrame) localVideoFrame.style.display = "inline-block";
    }
    isWebCamOn = !isWebCamOn;
  });
</script>

</body>
</html>
