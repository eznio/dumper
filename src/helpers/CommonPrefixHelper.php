<?php

namespace eznio\dumper\helpers;


class CommonPrefixHelper
{
    public static function find($strings)
    {
        $prefixLength = 0;
        $num = count($strings);
        $l = strlen($strings[0]);
        while ($prefixLength < $l) {
            $c = $strings[0][$prefixLength];
            for ($i=1; $i<$num; $i++) {
                if ($strings[$i][$prefixLength] !== $c) break 2;
            }
            $prefixLength++;
        }
        return substr($strings[0], 0, $prefixLength);
    }
}
