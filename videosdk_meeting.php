<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>VideoSDK Meeting</title>
  <script src="https://sdk.videosdk.live/js-sdk/0.0.87/videosdk.js"></script>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    button { margin: 10px; padding: 10px 20px; cursor: pointer; }
    #meeting-container { width: 100%; height: 80vh; border: 1px solid #ccc; margin-top: 20px; }
  </style>
</head>
<body>
  <h2>VideoSDK Meeting Demo</h2>
  
  <!-- Buttons -->
  <button id="create-btn">Create Meeting</button>
  <button id="join-btn">Join Meeting</button>

  <!-- Input for Meeting ID -->
  <div>
    <input type="text" id="meetingId" placeholder="Enter Meeting ID" style="padding:5px;" />
  </div>

  <!-- Meeting Container -->
  <div id="meeting-container"></div>

  <script>
    console.log("JS Loaded ✅");

    // Fetch token dynamically from server
    async function getToken() {
      try {
        const res = await fetch("/get-token.php");
        const data = await res.json();
        return data.token;
      } catch (err) {
        console.error("Failed to get token:", err);
        alert("Could not get token. Check server.");
      }
    }

    // Create Meeting Button
    document.getElementById("create-btn").addEventListener("click", async () => {
      console.log("Create button clicked!");
      const TOKEN = await getToken();
      if (!TOKEN) return;

      try {
        const response = await fetch("https://api.videosdk.live/v2/rooms", {
          method: "POST",
          headers: {
            Authorization: TOKEN,
            "Content-Type": "application/json"
          }
        });
        const data = await response.json();
        console.log("Meeting created:", data);

        if (data.roomId) {
          document.getElementById("meetingId").value = data.roomId;
          alert("New Meeting Created! ID: " + data.roomId);
          joinMeeting(data.roomId);
        } else {
          console.error("Failed to create meeting:", data);
        }
      } catch (err) {
        console.error("Error creating meeting:", err);
      }
    });

    // Join Meeting Button
    document.getElementById("join-btn").addEventListener("click", async () => {
      const meetingId = document.getElementById("meetingId").value;
      if (!meetingId) {
        alert("Please enter a Meeting ID");
        return;
      }
      joinMeeting(meetingId);
    });

    // Join an existing meeting
    async function joinMeeting(meetingId) {
      const TOKEN = await getToken();
      if (!TOKEN) return;

      console.log("Joining meeting:", meetingId);

      const meeting = VideoSDK.initMeeting({
        meetingId: meetingId,
        name: "Guest User",
        token: TOKEN,
        containerId: "meeting-container",
        micEnabled: true,
        webcamEnabled: true,
      });

      meeting.join();
    }
  </script>
</body>
</html>
