<?php

namespace eznio\dumper\renderers;


use eznio\ar\Ar;
use eznio\dumper\styles\BaseStyleInterface;
use eznio\dumper\styles\DefaultStyle;
use eznio\styler\Styler;
use eznio\dumper\helpers\CommonPrefixHelper;

abstract class AbstractRenderer
{
    /** @var BaseStyleInterface */
    protected $style;


    /**
     * Accepts given stylesheet or uses default one
     * @param null $style
     */
    public function __construct($style = null)
    {
        if (null === $style || ! $style instanceof BaseStyleInterface) {
            $this->style = new DefaultStyle();
        } else {
            $this->style = $style;
        }
    }

    /**
     * @return BaseStyleInterface
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param BaseStyleInterface $style
     * @return self
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * Max allowed nesting calculation. Zero (or no "nesting" key) mean "no limit"
     * @param $options
     * @return int|null
     */
    protected function getMaxNesting($options)
    {
        $maxNesting = (int) Ar::get($options, 'nesting');
        if (0 === $maxNesting) {
            $maxNesting = (int) Ar::get($options, 'depth');
        }
        return $maxNesting !== 0 ? $maxNesting : null;
    }

    /**
     * Max allowed nesting calculation. Zero (or no "nesting" key) mean "no limit"
     * @param $options
     * @return int|null
     */
    protected function getFileLineDump($options)
    {
        return (bool) Ar::get($options, 'line');
    }

    /**
     * Styler usage shortcut
     * @param $string
     * @param $style
     * @return string
     */
    protected function getStyled($string, $style)
    {
        return Styler::get($style) . $string . Styler::reset();
    }

    /**
     * Do I really have to comment this?
     * @param $line
     */
    protected function println($line)
    {
        echo $line . "\n";
    }

    /**
     * Calculates indention size
     * @param $string
     * @param $level
     * @param $spaces
     * @return string
     */
    protected function nest($string, $level, $spaces = 4) {
        return str_pad($string, strlen($string) + $level * $spaces, ' ', STR_PAD_LEFT);
    }

    /**
     * @param $callerData
     * @return string
     */
    protected function getClassNameColored($callerData)
    {
        $className = Ar::get($callerData, 'class');
        $separators = ['\\', '::', '->'];
        foreach ($separators as $separator) {
            $className = str_replace(
                $separator,
                $this->getStyled($separator, $this->style->getDumpSeparatorStyle()),
                $className
            );
        }

        $result =
            $className .
            $this->getStyled(Ar::get($callerData, 'type'), $this->style->getDumpSeparatorStyle()) .
            Ar::get($callerData, 'function') . '()';
        return $result;
    }

    protected function renderFileLine($callerData)
    {
        $callerData = current($callerData);
        $fileName = Ar::get($callerData, 'file');
        $commonPrefix = CommonPrefixHelper::find([$fileName, __DIR__]);

        $fileName = str_replace($commonPrefix, '', $fileName);
        $lineNumber = Ar::get($callerData, 'line');

        $this->println(sprintf(
            '< %s%s%s >',
            $this->getStyled($fileName, $this->style->getDumpFileStyle()),
            $this->getStyled(':', $this->style->getDumpColonStyle()),
            $this->getStyled($lineNumber, $this->style->getDumpLineStyle())
        ));
    }


}
