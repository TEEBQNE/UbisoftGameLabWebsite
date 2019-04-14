<?php
use Ratchet\Server\IoServer;
use MyApp\Chat;
	// creates the new web socket chat server to handle everything
	// creating based on the ratchet forums and their startup page
    require dirname(__DIR__) . '/vendor/autoload.php';

    $server = IoServer::factory(
        new Chat(),
        8080
    );

    $server->run();