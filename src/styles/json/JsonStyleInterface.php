<?php

namespace eznio\dumper\styles\json;


interface JsonStyleInterface
{
    public function getCurlyBracketStyle();
    public function getSquareBracketStyle();
    public function getQuotesStyle();
    public function getColonStyle();

    public function getStringKeyStyle();
    public function getStringValueStyle();
    public function getNumericKeyStyle();
    public function getNumericValueStyle();
    public function getCollapsedArrayStyle();

    public function getDumpClassStyle();
    public function getDumpFileStyle();
    public function getDumpLineStyle();
    public function getDumpColonStyle();
    public function getDumpSeparatorStyle();
}
