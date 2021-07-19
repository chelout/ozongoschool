<?php

use App\Application;
use App\Sequence;

require __DIR__ . '/../vendor/autoload.php';

$application = new Application(
    Sequence::generate($argv[1] ?? 10)
);
$application->run();
