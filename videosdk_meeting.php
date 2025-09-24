<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
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

<button id="create-btn">Create Meeting</button>
<button id="join-btn">Join Meeting</button>

<div>
<input type="text" id="meetingId" placeholder="Enter Meeting ID" style="padding:5px;" />
</div>

<div id="meeting-container"></div>

<script>
async function getServerToken() {
    try {
        const res = await fetch("get-token.php");
        const data = await res.json();
        return data;
    } catch(err) {
        console.error("Failed to get token:", err);
        alert("Server error. Check console.");
    }
}

// Create Meeting
document.getElementById("create-btn").addEventListener("click", async () => {
    const data = await getServerToken();
    if(!data) return;

    const roomId = data.roomId;
    if(roomId) {
        document.getElementById("meetingId").value = roomId;
        joinMeeting(roomId, data.token);
    } else {
        alert("Failed to create meeting");
    }
});

// Join Meeting
document.getElementById("join-btn").addEventListener("click", async () => {
    const meetingId = document.getElementById("meetingId").value.trim();
    if(!meetingId) {
        alert("Enter a Meeting ID");
        return;
    }

    const data = await getServerToken();
    if(!data) return;

    joinMeeting(meetingId, data.token);
});

function joinMeeting(meetingId, token) {
    console.log("Joining meeting:", meetingId);
    const meeting = VideoSDK.initMeeting({
        meetingId: meetingId,
        name: "Guest User",
        token: token,
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
