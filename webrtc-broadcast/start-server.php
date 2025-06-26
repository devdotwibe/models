<?php

$command = 'nohup php /var/www/models.staging3.dotwibe.com/html/webrtc-broadcast/server.php > /dev/null 2>&1 &';
exec($command);
echo "WebSocket server started.";
