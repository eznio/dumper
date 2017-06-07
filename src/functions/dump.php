<?php

if (!function_exists('dump')) {
    function dump()
    {
        call_user_func_array(['\eznio\dumper\Dumper', 'dump'], func_get_args());
    }


}
