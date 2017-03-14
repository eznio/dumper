<?php

namespace eznio\dumper\styles;


interface BaseStyleInterface
{
    public function getDumpClassStyle();
    public function getDumpFileStyle();
    public function getDumpLineStyle();
    public function getDumpColonStyle();
    public function getDumpSeparatorStyle();
}
