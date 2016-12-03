<?php

namespace eznio\dumper\styles\json;


use eznio\styler\references\ForegroundColors as Fg;

class DefaultStyle implements JsonStyleInterface
{
    public function getCurlyBracketStyle()
    {
        return [Fg::LIGHT_GREEN];
    }

    public function getSquareBracketStyle()
    {
        return [Fg::LIGHT_GREEN];
    }

    public function getQuotesStyle()
    {
        return [Fg::WHITE];
    }

    public function getColonStyle()
    {
        return [Fg::RED];
    }

    public function getStringKeyStyle()
    {
        return [Fg::CYAN];
    }

    public function getStringValueStyle()
    {
        return [Fg::WHITE];
    }

    public function getNumericKeyStyle()
    {
        return [Fg::CYAN];
    }

    public function getNumericValueStyle()
    {
        return [Fg::WHITE];
    }

    public function getCollapsedArrayStyle()
    {
        return [Fg::WHITE];
    }

    public function getDumpFileStyle()
    {
        return [Fg::RED];
    }

    public function getDumpColonStyle()
    {
        return [Fg::WHITE];
    }

    public function getDumpLineStyle()
    {
        return [Fg::RED];
    }

}