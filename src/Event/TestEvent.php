<?php

namespace App\Event;

class TestEvent
{
    public function __construct(
        private string $message
    )
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}