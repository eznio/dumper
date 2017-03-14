<?php

namespace eznio\dumper\styles\exception;


use eznio\styler\references\ForegroundColors as Fg;

class DefaultExceptionStyle implements ExceptionStyleInterface
{
    public function getCounterStyle()
    {
        return [Fg::YELLOW];
    }

    public function getClassNameStyle()
    {
        return [Fg::WHITE];
    }

    public function getClassSeparatorStyle()
    {
        return [Fg::RED];
    }

    public function getFunctionNameStyle()
    {
        return [Fg::WHITE];
    }

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