<?php

require_once __DIR__ . '/MessageInterface.php';

class ContentMessage implements MessageInterface
{
    /** @var string */
    private $content;

    /**
     * ContentMessage constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return json_encode([
            'content' => $this->getContent(),
        ], JSON_UNESCAPED_UNICODE);
    }
}