<?php

namespace eznio\dumper\styles\json;


use eznio\styler\references\ForegroundColors as Fg;

class DefaultJsonStyle implements JsonStyleInterface
{
    public function getCurlyBracketStyle()
    {
        return [Fg::WHITE];
    }

    public function getSquareBracketStyle()
    {
        return [Fg::WHITE];
    }

    public function getQuotesStyle()
    {
        return [Fg::WHITE];
    }

    public function getColonStyle()
    {
        return [Fg::LIGHT_RED];
    }

    public function getStringKeyStyle()
    {
        return [Fg::LIGHT_BLUE];
    }

    public function getStringValueStyle()
    {
        return [Fg::GREEN];
    }

    public function getNumericKeyStyle()
    {
        return [Fg::LIGHT_BLUE];
    }

    public function getNumericValueStyle()
    {
        return [Fg::GREEN];
    }

    public function getCollapsedArrayStyle()
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