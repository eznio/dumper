<?php

require __DIR__ . '/../vendor/autoload.php';

$array = [
    [ 'a' => 'b1', 'c' => 'd1', 'e' => 'fff1'],
    [ 'a' => 'b2', 'c' => 'd2', 'e' => 'fff2'],
    [ 'a' => 'b3', 'c' => 'd3', 'e' => 'fff3'],
    [ 'a' => 'b4', 'c' => 'd4', 'e' => 'fff4'],
];

\eznio\dumper\Dumper::dump($array);