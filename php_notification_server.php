<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\NotifyController;


require  'vendor/autoload.php';


$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new NotifyController()
        )
    ),
    8282
);

$server->run();
?>