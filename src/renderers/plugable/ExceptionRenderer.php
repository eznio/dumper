<?php

namespace eznio\dumper\renderers\plugable;


use eznio\ar\Ar;
use eznio\dumper\helpers\CommonPrefixHelper;
use eznio\dumper\interfaces\RendererInterface;
use eznio\dumper\renderers\AbstractRenderer;
use eznio\dumper\styles\exception\DefaultExceptionStyle;
use eznio\dumper\styles\exception\ExceptionStyleInterface;

class ExceptionRenderer
    extends AbstractRenderer
    implements RendererInterface
{
    /** @var ExceptionStyleInterface */
    protected $style;

    /**
     * Accepts given stylesheet or uses default one
     * @param null $style
     */
    public function __construct($style = null)
    {
        if (null === $style || ! $style instanceof ExceptionStyleInterface) {
            $this->style = new DefaultExceptionStyle();
        } else {
            $this->style = $style;
        }
    }

    /**
     * @param $object
     * @param array $options
     * @return mixed
     */
    public function accept($object, $options = [])
    {
        return $object instanceof \Exception;
    }

    /**
     * @param $object
     * @param array $options
     * @param array $callerData
     */
    public function render($object, $options = [], $callerData = [])
    {
        $shouldDumpFileLine = $this->getFileLineDump($options);
        if (true === $shouldDumpFileLine) {
            $this->renderFileLine($callerData);
        }

        /** @var \Exception $object */
        $trace = $object->getTrace();
        if (0 === count($trace)) {
            $this->println('Empty stack trace');
            return;
        }

        $commonPrefix = CommonPrefixHelper::find(
            Ar::map($trace, function ($item) {
                return Ar::get($item, 'file');
            })
        );
        if ('.php' === substr($commonPrefix, -4)) {
            $commonPrefix = str_replace(basename($commonPrefix), '', $commonPrefix);
        }

        $n = 1;
        foreach ($trace as $level) {
            $this->println($this->renderLevel($level, $commonPrefix, $n++));
        }

    }

    protected function renderLevel($level, $commonPrefix, $num)
    {
        return sprintf(' %2s  %s  %s',
            $this->getStyled($num, $this->style->getCounterStyle()),

            $this->getStyled(Ar::get($level, 'class'), $this->style->getClassNameStyle())
                . $this->getStyled(Ar::get($level, 'type'), $this->style->getClassSeparatorStyle())
                . $this->getStyled(Ar::get($level, 'function') . '()', $this->style->getFunctionNameStyle()),

            $this->getStyled(str_replace($commonPrefix, '', Ar::get($level, 'file')), $this->style->getDumpFileStyle())
                . $this->getStyled(':', $this->style->getDumpColonStyle())
                . $this->getStyled(Ar::get($level, 'line'), $this->style->getDumpLineStyle())
        );
    }
}
