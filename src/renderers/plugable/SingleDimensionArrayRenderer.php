<?php

namespace eznio\dumper\renderers\plugable;


use eznio\ar\Ar;
use eznio\dumper\interfaces\RendererInterface;
use eznio\dumper\renderers\AbstractRenderer;
use eznio\tabler\renderers\MysqlStyleRenderer;
use eznio\tabler\Tabler;

class SingleDimensionArrayRenderer
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
        return Ar::is1d($object);
    }

    /**
     * @param $array
     * @param array $options
     * @param array $callerData
     */
    public function render($array, $options = [], $callerData = [])
    {
        $shouldDumpFileLine = $this->getFileLineDump($options);
        if (true === $shouldDumpFileLine) {
            $this->renderFileLine($callerData);
        }

        $renderData = Ar::map($array, function($item, $key) {
            return [$key => [
                'key' => $key,
                'value' => $item
            ]];
        });

        echo (new Tabler())
            ->setRenderer(new MysqlStyleRenderer())
            ->setGuessHeaderNames(true)
            ->setData($renderData)
            ->render();
    }
}
