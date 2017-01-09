<?php

namespace eznio\dumper;


use eznio\dumper\interfaces\RendererInterface;
use eznio\ar\Ar;

class Dumper
{
    protected static $renderers = [];
    protected static $isInitialized = false;

    public static function dump($data, $options = [])
    {
        if (false === self::$isInitialized) {
            self::init();
        }

        $stack = debug_backtrace();
        foreach (self::$renderers as $renderer) {
            /** @var RendererInterface $renderer */
            if ($renderer->accept($data, $options)) {
                $renderer->render($data, $options, $stack);
                return;
            }
        }
    }

    public static function init(array $renderers = [])
    {
        $renderers = Ar::filter($renderers, function($renderer) {
            return $renderer instanceof RendererInterface;
        });
        if (count($renderers) > 0) {
            self::$renderers = $renderers;
        } else {
            self::$renderers = (new RenderersLoader())->load();
        }
        self::$isInitialized = true;
    }

    public static function addRenderer(RendererInterface $renderer)
    {
         self::$renderers[] = $renderer;
    }
}
