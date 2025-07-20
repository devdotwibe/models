<?php
$host = "0.0.0.0";
$port = 9898;

$server = stream_socket_server("tcp://$host:$port", $errno, $errstr);
if (!$server) die("Error: $errstr ($errno)\n");

$clients = [];

$clientsStreamLive = [];

while (true) {
    $read = $clients;
    $read[] = $server;
    stream_select($read, $write = null, $except = null, 0);

    if (in_array($server, $read)) {
        $client = stream_socket_accept($server);
        $clients[] = $client;
        $headers = fread($client, 1024);
        if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $headers, $matches)) {
            $key = base64_encode(pack('H*', sha1(trim($matches[1]) . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
            $upgrade = "HTTP/1.1 101 Switching Protocols\r\n"
                     . "Upgrade: websocket\r\n"
                     . "Connection: Upgrade\r\n"
                     . "Sec-WebSocket-Accept: $key\r\n\r\n";
            fwrite($client, $upgrade);
        }
        unset($read[array_search($server, $read)]);
    }

    foreach ($read as $client) {
        $data = fread($client, 2048);
        if (!$data) {
            fclose($client);
            unset($clients[array_search($client, $clients)]);
            continue;
        }

        $msg = unmask($data);
        $json = json_decode($msg, true);

        if ($json && $json['event'] === 'stream-chunk') {
            $hlsPath = __DIR__."/{$json['id']}";
            $m3u8File = $hlsPath . '/index.m3u8';
            
            if(!file_exists($m3u8File)){
                if (!file_exists($hlsPath)) {
                    if (!mkdir($hlsPath, 0777, true)) {
                        die("Failed to create HLS output directory.");
                    }
                }
                chmod($hlsPath, 0777);
                $clientsStreamLive["{$json['id']}ffmpeg"] = proc_open(
                    "ffmpeg -f webm -i pipe:0 -c:v libx264 -preset ultrafast -g 25 -sc_threshold 0 -c:a aac -b:a 128k -f hls -hls_time 2 -hls_list_size 5 -hls_flags delete_segments+append_list $m3u8File",
                    [["pipe", "r"], ["pipe", "w"], ["pipe", "w"]],
                    $pipes
                );
                $clientsStreamLive["{$json['id']}pipes"]=$pipes;
            }

            $binary = base64_decode($json['data']);
            // fwrite($clientsStreamLive["{$json['id']}pipes"][0], $binary);
            echo "Received chunk at " . date('H:i:s') . "\n";
        }        
        if ($json && $json['event'] === 'stream-end') {
            if (isset($clientsStreamLive["{$json['id']}pipes"][0])) fclose($clientsStreamLive["{$json['id']}pipes"][0]);
            if (isset($clientsStreamLive["{$json['id']}pipes"][1])) fclose($clientsStreamLive["{$json['id']}pipes"][1]);
            if (isset($clientsStreamLive["{$json['id']}pipes"][2])) fclose($clientsStreamLive["{$json['id']}pipes"][2]);
            if (is_resource($clientsStreamLive["{$json['id']}ffmpeg"])) {
                proc_close($clientsStreamLive["{$json['id']}ffmpeg"]);
            }
        }
    }
}

function unmask($payload) {
    $length = ord($payload[1]) & 127;
    if ($length == 126) {
        $masks = substr($payload, 4, 4);
        $data = substr($payload, 8);
    } elseif ($length == 127) {
        $masks = substr($payload, 10, 4);
        $data = substr($payload, 14);
    } else {
        $masks = substr($payload, 2, 4);
        $data = substr($payload, 6);
    }

    $text = '';
    for ($i = 0; $i < strlen($data); ++$i) {
        $text .= $data[$i] ^ $masks[$i % 4];
    }
    return $text;
}
