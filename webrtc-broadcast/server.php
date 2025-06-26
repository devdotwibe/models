<?php
require 'vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class SignalingServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Signaling server started...\n";
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

    $loop = React\EventLoop\Factory::create();
    $socket = new React\Socket\Server('0.0.0.0:8080', $loop);

    $secure_websockets = new React\Socket\SecureServer($socket, $loop, [
        'local_cert'  => '/etc/letsencrypt/live/models.staging3.dotwibe.com/webrtc-broadcast/fullchain.pem',
        'local_pk'    => '/etc/letsencrypt/live/models.staging3.dotwibe.com/webrtc-broadcast/privkey.pem',
        'allow_self_signed' => true,
        'verify_peer' => false
    ]);

    $server = new Ratchet\Server\IoServer(
        new Ratchet\Http\HttpServer(
            new Ratchet\WebSocket\WsServer(
                new SignalingServer()
            )
        ),
        $secure_websockets,
        $loop
    );

$server->run();
