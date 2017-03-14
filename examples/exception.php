<?php

require '../vendor/autoload.php';

function a()
{
    b();
}

function b() {
    throw new \Exception();
}

class c
{
    function d()
    {
        a();
    }
}

try {
    $c = new c();
    $c->d();
} catch (\Exception $e) {
    \eznio\dumper\Dumper::dump($e, ['line' => true]);
}
