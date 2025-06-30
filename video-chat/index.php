<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WebRTC Video Conference</title>
  <style>
    video { width: 300px; height: 200px; margin: 10px; }
  </style>
</head>
<body>
  <h2>WebRTC Video Chat Room</h2>
  <video id="localVideo" autoplay muted playsinline></video>
  <video id="remoteVideo" autoplay playsinline></video>

  <?php
  function generateTurnCredentials($secret, $realm = '209.182.232.170') {
    $unixTimestamp = time() + 3600; // valid for 1 hour
    $username = (string)$unixTimestamp;

    $password = base64_encode(hash_hmac('sha1', $username . ':' . $realm, $secret, true));

    return [
        'username' => $username,
        'password' => $password
    ];
} ?>
<script>
  let credintial = <?=generateTurnCredentials('88d6f2e0208e1bcddbee2d2a6a957c3a')?>;

  console.log(credintial);
</script>

  <script src="webrtc.js"></script>
</body>
</html>
