<?php

namespace eznio\dumper\interfaces;


interface RendererInterface
{
    public function accept($object, $options = []);
    public function render($object, $options = []);
}
