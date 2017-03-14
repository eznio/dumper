<?php

namespace eznio\dumper\styles\exception;


use eznio\dumper\styles\BaseStyleInterface;

interface ExceptionStyleInterface extends BaseStyleInterface
{
    public function getCounterStyle();

    public function getClassNameStyle();
    public function getClassSeparatorStyle();
    public function getFunctionNameStyle();
}
