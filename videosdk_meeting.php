<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>VideoSDK Meeting Demo</title>
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
console.log("JS Loaded ✅");

// Fetch fresh token from server
async function getToken() {
    try {
        const res = await fetch("get-token.php");
        const data = await res.json();
        return data.token;
    } catch (err) {
        console.error("Failed to get token:", err);
        alert("Could not fetch token from server.");
    }
}

// Create a new meeting
document.getElementById("create-btn").addEventListener("click", async () => {
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
            alert("Meeting created! ID: " + data.roomId);
            joinMeeting(data.roomId);
        } else {
            alert("Failed to create meeting. Check console.");
        }
    } catch (err) {
        console.error("Error creating meeting:", err);
        alert("Error creating meeting.");
    }
});

// Join a meeting
document.getElementById("join-btn").addEventListener("click", async () => {
    const meetingId = document.getElementById("meetingId").value.trim();
    if (!meetingId) {
        alert("Please enter a Meeting ID");
        return;
    }
    joinMeeting(meetingId);
});

// Function to join a meeting
async function joinMeeting(meetingId) {
    const TOKEN = await getToken(); // get fresh token
    if (!TOKEN) return;

    console.log("Joining meeting:", meetingId);

    const meeting = VideoSDK.initMeeting({
        meetingId: meetingId,
        name: "Guest User",
        token: TOKEN,
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
