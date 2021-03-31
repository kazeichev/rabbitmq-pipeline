<?php


interface HandlerInterface
{
    /**
     * @param $json
     * @return mixed
     */
    public function deserialize(string $json);
}