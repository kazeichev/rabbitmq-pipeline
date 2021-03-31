<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Handlers/ContentMessageHandler.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('rabbitmq.kazeichev.ru', 5672, 'guest', 'guest');

$channel = $connection->channel();
$channel->queue_declare('main_queue', false, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    (new ContentMessageHandler($msg->body))();
    $msg->ack();
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('main_queue', '', false, false, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();