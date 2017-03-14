<?php

namespace eznio\dumper\styles\json;


use eznio\dumper\styles\BaseStyleInterface;

interface JsonStyleInterface extends BaseStyleInterface
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
}
