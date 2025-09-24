<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;

// VideoSDK credentials
$API_KEY = "d9e05d67-8f16-4c02-bbc4-933f7603bf7d"; // Public API key
$API_SECRET = "8c812d371cdd9313dcb62738ad900ead2933f1f91f3cb30bef71e6e90567b438"; // Secret

// Generate token server-side
$payload = [
    "apikey" => $API_KEY,
    "permissions" => ["allow_join", "allow_mod"],
    "iat" => time(),
    "exp" => time() + 60*60*24  // 24 hours
];

$VIDEOSDK_TOKEN = JWT::encode($payload, $API_SECRET, 'HS256');
?>
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
const TOKEN = "<?php echo $VIDEOSDK_TOKEN; ?>";
console.log("Token from PHP:", TOKEN);

// Create Meeting
document.getElementById("create-btn").addEventListener("click", async () => {
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
            joinMeeting(data.roomId);
        } else {
            alert("Failed to create meeting. Check console.");
        }
    } catch (err) {
        console.error(err);
        alert("Error creating meeting.");
    }
});

// Join Meeting
document.getElementById("join-btn").addEventListener("click", () => {
    const meetingId = document.getElementById("meetingId").value.trim();
    if (!meetingId) {
        alert("Please enter a Meeting ID");
        return;
    }
    joinMeeting(meetingId);
});

// Join Meeting Function
function joinMeeting(meetingId) {
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
