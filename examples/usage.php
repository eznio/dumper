<?php

require '../vendor/autoload.php';

\eznio\dumper\Dumper::dump(
    file_get_contents('large.json'),
    [
        'nesting' => 3,
        'line' => true
    ]
);
