<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($data['id_forward'])) {
                
                echo "ID TIN NHẮN ĐƯỢC CHUYỂN TIẾP: " . $data['id_forward'] . "\n";
                
                } else {
                    echo "TIN NHẮN NHẬN ĐƯỢC: {$msg}\n";  // Tin nhắn nhận được kiểu json
            }
        } else {
            echo "TIN NHẮN KHÔNG PHẢI JSON HOẶC JSON KHÔNG HỢP LỆ\n";
        }


        //gửi lại tin nhắn cho client
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
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();