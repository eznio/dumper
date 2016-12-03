<?php

namespace eznio\dumper\renderers;


use eznio\dumper\interfaces\RendererInterface;

class VarDumpRenderer implements RendererInterface
{
    public function accept($object, $options = [])
    {
        return true;
    }

    public function render($object, $options = [])
    {
        var_dump($object);
    }
}
