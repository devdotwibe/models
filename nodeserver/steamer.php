<?php
session_start();

$is_logged_in = true; // Simulated login
$current_user = [
    'id' => 1,
    'username' => 'john_doe',
    'email' => 'john@example.com',
];

$stream_created = false;
$stream_key = '12345'; // Unique stream key (can be dynamic)
$rtmp_url = 'rtmp://3.6.71.231/video';
$playback_url = "https://3.6.71.231/video/{$stream_key}/index.m3u8";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wplsm_submit_stream'])) {
    $stream_created = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Streamer Dashboard</title>
    <link href="https://vjs.zencdn.net/8.5.1/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/8.5.1/video.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f2f2f2;
        }
        .container {
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        input, .btn {
            width: 100%;
            padding: 10px;
            margin-top: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .btn {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .info-block {
            background: #e9ecef;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
        }
        code {
            background: #fff3cd;
            padding: 3px 6px;
            border-radius: 4px;
        }
        .video-preview {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (!$is_logged_in): ?>
        <p>You must be <a href="login.php">logged in</a> to access this page.</p>
    <?php else: ?>
        <h2>🎥 Streamer Dashboard</h2>

        <?php if ($stream_created): ?>
            <div class="info-block">
                <p><strong>RTMP Server URL:</strong><br>
                    <code><?php echo $rtmp_url; ?></code></p>

                <p><strong>Stream Key:</strong><br>
                    <code><?php echo $stream_key; ?></code></p>

                <p><strong>HLS Playback URL:</strong><br>
                    <a href="<?php echo $playback_url; ?>" target="_blank"><?php echo $playback_url; ?></a></p>
            </div>

            <div class="video-preview">
                <h3>🔴 Live Preview</h3>
                <video
                    id="live_player"
                    class="video-js vjs-default-skin"
                    controls
                    autoplay
                    preload="auto"
                    width="640"
                    height="360"
                    data-setup='{}'>
                    <source src="<?php echo $playback_url; ?>" type="application/x-mpegURL">
                    Your browser does not support HLS playback.
                </video>
            </div>

            <div class="info-block" style="margin-top: 30px;">
                <h4>📺 Streaming Instructions</h4>
                <p>Use software like <strong>OBS Studio</strong> to start streaming:</p>
                <ul>
                    <li><strong>Stream Type:</strong> Custom</li>
                    <li><strong>Server:</strong> <code><?php echo $rtmp_url; ?></code></li>
                    <li><strong>Stream Key:</strong> <code><?php echo $stream_key; ?></code></li>
                </ul>
                <p>After starting your stream in OBS, your video will appear in the live preview above.</p>
            </div>

        <?php else: ?>
            <form method="POST">
                <input type="submit" name="wplsm_submit_stream" class="btn" value="Generate My Stream Info">
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
