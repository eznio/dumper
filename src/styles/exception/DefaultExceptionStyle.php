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
        return [Fg::LIGHT_GRAY];
    }

    public function getFunctionNameStyle()
    {
        return [Fg::WHITE];
    }

    public function getExceptionFileStyle()
    {
        return [Fg::DARK_GRAY];
    }

    public function getExceptionColonStyle()
    {
        return [Fg::WHITE];
    }

    public function getExceptionLineStyle()
    {
        return [Fg::DARK_GRAY];
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