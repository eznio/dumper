<?php

namespace eznio\dumper;


class RenderersLoader
{
    public function load()
    {
        $renderersDirectory = $this->getDefaultRenderersDirectory();
        return $this->getRenderersFromDir($renderersDirectory);
    }

    public function getRenderersFromDir($directory)
    {
        $renderers = [];
        $dir = glob($directory . '*.php');

        foreach ($dir as $file) {
            if ('VarDumpRenderer.php' === basename($file)) {
                continue;
            }

            if (!is_readable($file)) {
                continue;
            }
            include_once($file);

            $fullClassName = 'eznio\\dumper\\renderers\\' . substr(basename($file), 0, -4);
            if (class_exists($fullClassName)) {
                $renderers[] = new $fullClassName();
            }
        }

        $defaultRendererFile = $directory . 'VarDumpRenderer.php';
        $defaultRendererClass = 'eznio\\dumper\\renderers\\VarDumpRenderer';
        if (file_exists($defaultRendererFile)) {
            include_once($defaultRendererFile);
            if (class_exists($defaultRendererClass)) {
                $renderers[] = new $defaultRendererClass();
            }
        }

        return $renderers;
    }

    public function getDefaultRenderersDirectory()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR;
    }
}
