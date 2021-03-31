<?php

require_once __DIR__ . '/HandlerInterface.php';
require_once __DIR__ . '/../Messages/ContentMessage.php';

class ContentMessageHandler implements HandlerInterface
{
    /** @var ContentMessage  */
    private $message;

    /**
     * ContentMessageHandler constructor.
     * @param $json
     */
    public function __construct($json)
    {
        $this->message = $this->deserialize($json);
    }

    public function __invoke()
    {
        echo 'Received message: ' . $this->message->getContent() . "\n";
    }

    /**
     * @param string $json
     * @return ContentMessage
     */
    public function deserialize(string $json)
    {
        $data = json_decode($json, true);
        return new ContentMessage($data['content']);
    }
}