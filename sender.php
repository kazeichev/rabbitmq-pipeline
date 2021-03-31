<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Messages/ContentMessage.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq.kazeichev.ru', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('main_queue', false, true, false, false);


$msg = new AMQPMessage(
    (new ContentMessage('Тестовый контент'))->serialize(),
    ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
);

$channel->basic_publish($msg, '', 'main_queue');

$channel->close();
$connection->close();