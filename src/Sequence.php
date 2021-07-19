<?php

namespace App;

use DateTime;

class Sequence
{
    public const SECONDS_PER_DAY = 86400;

    public static function generate(int $count = 10): array
    {
        $times = [];

        for ($i = 0; $i < $count; $i++) {
            $start = random_int(0, static::SECONDS_PER_DAY - 1);
            $end = random_int($start, static::SECONDS_PER_DAY);

            $startDate = DateTime::createFromFormat('U', $start);
            $endDate = DateTime::createFromFormat('U', $end);

            $times[] = [$startDate->format('H:i'), $endDate->format('H:i')];
        }

        return $times;
    }
}