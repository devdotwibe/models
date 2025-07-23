<?php
session_start();

$is_logged_in = true;
$current_user = [
    'id' => 1,
    'username' => 'john_doe',
    'email' => 'john@example.com',
];

$stream_created = false;
$stream_key = '12345'; // Static stream key
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f2f2f2;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .info-block {
            background: #e9ecef;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
        }
        code {
            background: #fff3cd;
            padding: 2px 6px;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
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

           
                    <a href="<?php echo $playback_url; ?>" target="_blank"><?php echo $playback_url; ?></a></p>
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
