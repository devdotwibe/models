<?php
// Get current directory
$currentDir = __DIR__;
echo "Current directory: $currentDir\n";

// Build full path to server.php
$command = "nohup php $currentDir/server.php > /dev/null 2>&1 &";
// exec($command);

echo "WebSocket server started." .$command;
