<?php

namespace eznio\dumper\styles\xml;


use eznio\styler\references\ForegroundColors as Fg;

class DefaultStyle implements XmlStyleInterface
{
    /**
     * @return mixed
     */
    public function getSquareBracketStyle()
    {
        return [Fg::WHITE];
    }

    /**
     * @return mixed
     */
    public function getQuestionBracketStyle()
    {
        return [Fg::RED];
    }

    /**
     * @return mixed
     */
    public function getQuotesStyle()
    {
        return [Fg::WHITE];
    }

    /**
     * @return mixed
     */
    public function getEqualsSignStyle()
    {
        return [Fg::LIGHT_RED];
    }

    /**
     * @return mixed
     */
    public function getTagNameStyle()
    {
        return [Fg::LIGHT_BLUE];
    }

    /**
     * @return mixed
     */
    public function getTagStringValueStyle()
    {
        return [Fg::GREEN];
    }

    /**
     * @return mixed
     */
    public function getTagNumericValueStyle()
    {
        return [Fg::GREEN];
    }

    /**
     * @return mixed
     */
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