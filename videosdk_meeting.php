<?php
// index.php
// Replace with your actual VideoSDK Auth Token
$VIDEOSDK_TOKEN = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGlrZXkiOiJkOWUwNWQ2Ny04ZjE2LTRjMDItYmJjNC05MzNmNzYwM2JmN2QiLCJwZXJtaXNzaW9ucyI6WyJhbGxvd19qb2luIl0sImlhdCI6MTc1ODY5MDQ5NywiZXhwIjoxOTE2NDc4NDk3fQ.G431dK7iF2s_O93l5qd-PqBE5Vu31srL7-lsR_M1mKM";
?>
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

    const TOKEN = "<?php echo $VIDEOSDK_TOKEN; ?>";
    console.log("Token from PHP:", TOKEN);

    // Create Meeting Button
    document.getElementById("create-btn").addEventListener("click", () => {
      console.log("Create button clicked!");
      createMeeting();
    });

    // Join Meeting Button
    document.getElementById("join-btn").addEventListener("click", () => {
      console.log("Join button clicked!");
      const meetingId = document.getElementById("meetingId").value;
      if (!meetingId) {
        alert("Please enter a Meeting ID");
        return;
      }
      joinMeeting(meetingId);
    });

    // Create a new meeting
    async function createMeeting() {
      try {
        console.log("Creating meeting...");
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
        } else {
          console.error("Failed to create meeting:", data);
        }
      } catch (err) {
        console.error("Error creating meeting:", err);
      }
    }

    // Join an existing meeting
    function joinMeeting(meetingId) {
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
