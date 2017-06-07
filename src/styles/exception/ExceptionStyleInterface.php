<?php

namespace eznio\dumper\styles\exception;


use eznio\dumper\styles\BaseStyleInterface;

interface ExceptionStyleInterface extends BaseStyleInterface
{
    public function getCounterStyle();

    public function getExceptionFileStyle();
    public function getExceptionColonStyle();
    public function getExceptionLineStyle();

    public function getClassNameStyle();
    public function getClassSeparatorStyle();
    public function getFunctionNameStyle();
}
