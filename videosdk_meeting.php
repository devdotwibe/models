<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>VideoSDK Meeting (No JWT)1</title>
<script src="https://sdk.videosdk.live/js-sdk/0.0.87/videosdk.js"></script>
<style>
body { font-family: Arial, sans-serif; padding: 20px; }
button { margin: 10px; padding: 10px 20px; cursor: pointer; }
#meeting-container { width: 100%; height: 80vh; border: 1px solid #ccc; margin-top: 20px; }
input { padding: 5px; }
</style>
</head>
<body>

<h2>VideoSDK Meeting Demo (No JWT)</h2>

<button id="create-btn">Create Meeting</button>
<button id="join-btn">Join Meeting</button>

<div>
  <input type="text" id="meetingId" placeholder="Enter Meeting ID" />
</div>

<div id="meeting-container"></div>

<script>
  // 🔑 Use your App Token from VideoSDK Dashboard
  const APP_TOKEN = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGlrZXkiOiJkOWUwNWQ2Ny04ZjE2LTRjMDItYmJjNC05MzNmNzYwM2JmN2QiLCJwZXJtaXNzaW9ucyI6WyJhbGxvd19qb2luIl0sImlhdCI6MTc1ODY5NDQ5NywiZXhwIjoxOTE2NDgyNDk3fQ.Ehj-qmFcHUSxS-u9pHWjzJFPpi4HG0SFmr5jG-gJz9o";

  // Create a new meeting
  document.getElementById("create-btn").addEventListener("click", async () => {
    try {
      const res = await fetch("https://api.videosdk.live/v2/rooms", {
        method: "POST",
        headers: {
          Authorization: APP_TOKEN,
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          name: "My Test Room",
          recording: false
        })
      });

      const data = await res.json();
      console.log("Room created:", data);

      if (data.roomId) {
        document.getElementById("meetingId").value = data.roomId;
        joinMeeting(data.roomId);
      } else {
        alert("Failed to create room. Check console.");
      }
    } catch (err) {
      console.error("Error creating room:", err);
      alert("Error creating room. See console.");
    }
  });

  // Join meeting button
  document.getElementById("join-btn").addEventListener("click", () => {
    const meetingId = document.getElementById("meetingId").value.trim();
    if (!meetingId) {
      alert("Please enter a Meeting ID");
      return;
    }
    joinMeeting(meetingId);
  });

  // Function to join a meeting
  function joinMeeting(meetingId) {
    console.log("Joining meeting:", meetingId);

    const meeting = VideoSDK.initMeeting({
      meetingId: meetingId,
      name: "Guest User",
      token: APP_TOKEN,
      containerId: "meeting-container",
      micEnabled: true,
      webcamEnabled: true
    });

    meeting.join();

    meeting.on("error", err => {
      console.error("Meeting error:", err);
      alert("Error joining meeting. Check console.");
    });
  }
</script>

</body>
</html>
