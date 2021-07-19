<?php

namespace App;

use Closure;

class Application
{
    private array $durations;

    private array $times;

    public function __construct(array $durations)
    {
        $this->durations = $durations;
    }

    public function run(): void
    {
        $count = $this->prepareDurations()
            ->sort()
            ->countIntersections();

        echo $count . PHP_EOL;
    }

    private function prepareDurations(): static
    {
        foreach ($this->durations as $duration) {
            $this->times[] = Time::start($duration[0]);
            $this->times[] = Time::end($duration[1]);
        }

        return $this;
    }

    private function sort(): static
    {
        usort($this->times, $this->callback());

        return $this;
    }

    private function callback(): Closure
    {
        return static function (Time $a, Time $b) {
            if ($a->getTime() > $b->getTime()) {
                return 1;
            }

            if ($a->getTime() < $b->getTime()) {
                return -1;
            }

            if ($a->getTime() === $b->getTime() && $a->isStart() === true && $b->isStart() === false) {
                return -1;
            }

            if ($a->getTime() === $b->getTime() && $a->isStart() === false && $b->isStart() === true) {
                return 1;
            }

            return 0;
        };
    }

    private function countIntersections(): int
    {
        $count = 0;
        $maxCount = 0;
        foreach ($this->times as $time) {
            if ($time->isStart()) {
                $count++;
            } else {
                $count--;
            }
            $maxCount = max($maxCount, $count);
        }

        return $maxCount;
    }
}