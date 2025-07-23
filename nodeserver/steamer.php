<?php
session_start();

$is_logged_in = true;
$current_user = [
    'id' => 1,
    'username' => 'john_doe',
    'email' => 'john@example.com',
];

$stream_created = false;
$stream_key = '12345';
$stream_title = '';
$description = '';
$playback_url = '';
$rtmp_url = 'rtmp://creator74.com/live/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wplsm_submit_stream'])) {
    $stream_title = htmlspecialchars($_POST['stream_title'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    $playback_url = "https://3.6.71.231/video/{$stream_key}/index.m3u8";
    $stream_created = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Stream</title>
    <link href="https://vjs.zencdn.net/8.5.1/video-js.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .info-block {
            background: #e9ecef;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
        }
        .video-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (!$is_logged_in): ?>
        <p>You must be <a href="login.php">logged in</a> to create a stream.</p>
    <?php else: ?>
        <h2>Create Live Stream</h2>

        <?php if ($stream_created): ?>
            <div class="success">
                <p>Your stream has been created.</p>
                <p><strong>Stream Key:</strong> <code><?php echo $stream_key; ?></code></p>
            </div>

            <div class="info-block">
                <p><strong>RTMP URL:</strong> <code><?php echo $rtmp_url; ?></code></p>
                <p><strong>Stream Key:</strong> <code><?php echo $stream_key; ?></code></p>
                <p><strong>Playback URL:</strong> <code><a href="<?php echo $playback_url; ?>" target="_blank"><?php echo $playback_url; ?></a></code></p>
                <p>Status: 🔴 Offline — Viewers: 0</p>
            </div>

            <div class="video-container">
                <video
                    id="live_stream_player"
                    class="video-js vjs-default-skin"
                    controls
                    autoplay
                    preload="auto"
                    width="720"
                    height="400"
                    data-setup='{}'>
                    <source src="<?php echo $playback_url; ?>" type="application/x-mpegURL">
                    Your browser does not support HLS streaming.
                </video>
            </div>
        <?php else: ?>
            <form method="POST">
                <input type="submit" name="wplsm_submit_stream" value="Create Stream">
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script src="https://vjs.zencdn.net/8.5.1/video.min.js"></script>
</body>
</html>
