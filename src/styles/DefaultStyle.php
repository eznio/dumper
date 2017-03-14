<?php

namespace eznio\dumper\styles;


use eznio\styler\references\ForegroundColors as Fg;

class DefaultStyle implements BaseStyleInterface
{
    public function getDumpClassStyle()
    {
        return [Fg::WHITE];
    }

    public function getDumpSeparatorStyle()
    {
        return [Fg::RED];
    }

    public function getDumpFileStyle()
    {
        return [Fg::RED];
    }
    public function getDumpLineStyle()
    {
        return [Fg::RED];
    }

    public function getDumpColonStyle()
    {
        return [Fg::WHITE];
    }
}