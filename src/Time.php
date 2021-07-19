<?php

namespace App;

class Time
{
    private string $time;

    private bool $isStart;

    public function __construct(string $time, bool $isStart)
    {
        $this->time = $time;
        $this->isStart = $isStart;
    }

    public static function start(string $time): static
    {
        return new static($time, true);
    }

    public static function end(string $time): static
    {
        return new static($time, false);
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function isStart(): bool
    {
        return $this->isStart;
    }
}