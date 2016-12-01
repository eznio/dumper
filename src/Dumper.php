<?php

namespace eznio\dumper;


use eznio\dumper\interfaces\RendererInterface;

class Dumper
{
    protected static $renderers = [];
    protected static $isInitialized = false;

    public static function dump($data, $options = [])
    {
        if (false === self::$isInitialized) {
            self::init();
        }
        foreach (self::$renderers as $renderer) {
            /** @var RendererInterface $renderer */
            if ($renderer->accept($data, $options)) {
                $renderer->render($data, $options);
                return;
            }
        }
    }

    public static function init()
    {
        self::$renderers = (new RenderersLoader())->load();
        self::$isInitialized = true;
    }

    public static function addRenderer(RendererInterface $renderer)
    {
         self::$renderers[] = $renderer;
    }
}
