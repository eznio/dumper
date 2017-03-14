<?php

require __DIR__ . '/../vendor/autoload.php';

$array = [
    'a' => 'b',
    'c' => 'd',
    'e' => 'fff'
];

\eznio\dumper\Dumper::dump($array);