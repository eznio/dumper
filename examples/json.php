<?php

require '../vendor/autoload.php';

\eznio\dumper\Dumper::dump(file_get_contents('large.json'), ['depth' => 3]);
