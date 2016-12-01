<?php

namespace eznio\dumper\renderers;


use eznio\dumper\interfaces\RendererInterface;

class JsonVarDumpRenderer implements RendererInterface
{
    public function accept($object, $options = [])
    {
        return null !== json_decode($object, true);
    }

    public function render($object, $options = [])
    {
        var_dump(json_decode($object));
    }
}
