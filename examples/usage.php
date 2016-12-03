<?php

//$array = [];
//Dumper::dump($array);
//
//$json = json_encode($array);
//Dumper::dump($json, ['nesting' => 2]);

require '../vendor/autoload.php';

\eznio\dumper\Dumper::dump(file_get_contents('large.json'), ['nesting' => 2, 'line' => true]);
