<?php

require '../vendor/autoload.php';

function a()
{
    b();
}

function b() {
    throw new \Exception();
}

try {
    a();
} catch (\Exception $e) {
    \eznio\dumper\Dumper::dump(
        $e,
        [
            'line' => true
        ]
    );

}
