<?php

namespace eznio\dumper\renderers\plugable;


use eznio\ar\Ar;
use eznio\dumper\interfaces\RendererInterface;
use eznio\dumper\renderers\AbstractRenderer;
use eznio\tabler\renderers\MysqlStyleRenderer;
use eznio\tabler\Tabler;

class DoubleDimensionArrayRenderer
    extends AbstractRenderer
    implements RendererInterface
{
    /**
     * @param $object
     * @param array $options
     * @return mixed
     */
    public function accept($object, $options = [])
    {
        return Ar::is2d($object);
    }

    /**
     * @param $array
     * @param array $options
     * @param array $callerData
     */
    public function render($array, $options = [], $callerData = [])
    {
        echo (new Tabler())
            ->setRenderer(new MysqlStyleRenderer())
            ->setGuessHeaderNames(true)
            ->setData($array)
            ->render();
    }
}
