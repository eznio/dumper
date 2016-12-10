<?php

namespace eznio\dumper\renderers;


use eznio\ar\Ar;
use eznio\dumper\helpers\CommonPrefixHelper;
use eznio\dumper\interfaces\RendererInterface;
use eznio\dumper\styles\json\DefaultStyle;
use eznio\dumper\styles\json\JsonStyleInterface;
use eznio\styler\Styler;

/**
 * Formats and renders JSON
 * @package eznio\dumper\renderers
 */
class JsonRenderer implements RendererInterface
{
    /** @var JsonStyleInterface */
    protected $style = null;

    /**
     * Accepts given stylesheet or uses default one
     * @param null $style
     */
    public function __construct($style = null)
    {
        if (null === $style || ! $style instanceof JsonStyleInterface) {
            $this->style = new DefaultStyle();
        } else {
            $this->style = $style;
        }
    }

    /**
     * Checks if given object is really JSON
     * @param $object
     * @param array $options
     * @return bool
     */
    public function accept($object, $options = [])
    {
        return is_array(json_decode($object, true));
    }

    /**
     * Render entrance
     * @param $object
     * @param array $options
     */
    public function render($object, $options = [])
    {
        $maxNesting = $this->getMaxNesting($options);
        $shouldDumpFileLine = $this->getFileLineDump($options);

        $currentNesting = 1;
        $data = json_decode($object, true);

        if (true === $shouldDumpFileLine) {
            $this->renderFileLine();
        }
        $this->println($this->getStyled('{', $this->style->getCurlyBracketStyle()));
        $this->renderLevel($data, $currentNesting, $maxNesting);
        $this->println($this->getStyled('{', $this->style->getCurlyBracketStyle()));
    }

    protected function renderFileLine()
    {
        $trace = debug_backtrace();
        $callerData = Ar::get($trace, 2);
        if (null === $callerData) {
            return;
        }

        $fileName = Ar::get($callerData, 'file');
        $commonPrefix = CommonPrefixHelper::find([$fileName, __DIR__]);

        $className = $this->getClassNameColored($callerData);
        $fileName = str_replace($commonPrefix, '', $fileName);
        $lineNumber = Ar::get($callerData, 'line');

        $this->println(sprintf(
            '%s%s%s%s%s',
            $this->getStyled($fileName, $this->style->getDumpFileStyle()),
            $this->getStyled(':', $this->style->getDumpColonStyle()),
            $this->getStyled($lineNumber, $this->style->getDumpLineStyle()),
            $this->getStyled(' - ', $this->style->getDumpColonStyle()),
            $this->getStyled($className, $this->style->getDumpClassStyle())
        ));
    }

    /**
     * Renders single nesting level, recursive one
     * @param $data
     * @param $currentNesting
     * @param $maxNesting
     */
    protected function renderLevel($data, $currentNesting, $maxNesting)
    {
        foreach ($data as $key => $item) {
            $this->renderItem($key, $item, $currentNesting, $maxNesting);
        }
    }

    /**
     * Renders single item (key + value)
     * @param $key
     * @param $item
     * @param $currentNesting
     * @param $maxNesting
     */
    protected function renderItem($key, $item, $currentNesting, $maxNesting)
    {
        if (is_array($item)) {
            $this->renderArrayItem($key, $item, $currentNesting, $maxNesting);
        } else {
            $this->renderScalarItem($key, $item, $currentNesting);
        }
    }

    /**
     * Renders single item containing array
     * @param $key
     * @param $item
     * @param $currentNesting
     * @param $maxNesting
     */
    protected function renderArrayItem($key, $item, $currentNesting, $maxNesting)
    {
        $styledColon = $this->getStyled(':', $this->style->getColonStyle()) ;
        $styledKey = $this->getStyledKey($key);

        list($prefix, $suffix) = $this->getStyledBrackets($item);

        if (null !== $maxNesting && $currentNesting >= $maxNesting) {
            $styledCollapsedArray = sprintf(
                '%s ... %d ... %s',
                Styler::get($this->style->getCollapsedArrayStyle()),
                count($item),
                Styler::reset()
            );

            $this->println(
                $this->nest(sprintf(
                    '"%s"%s %s%s%s',
                    $styledKey,
                    $styledColon,
                    $prefix,
                    $styledCollapsedArray,
                    $suffix
                ), $currentNesting)
            );
        } else {
            $this->println(
                $this->nest(sprintf(
                    '"%s"%s %s',
                    $styledKey,
                    $styledColon,
                    $prefix
                ), $currentNesting)
            );
            $this->renderLevel($item, $currentNesting + 1, $maxNesting);
            $this->println(
                $this->nest($suffix, $currentNesting)
            );

        }
    }

    /**
     * Renders single scalar-value item
     * @param $key
     * @param $item
     * @param $currentNesting
     */
    protected function renderScalarItem($key, $item, $currentNesting)
    {
        $styledColon = $this->getStyled(':', $this->style->getColonStyle()) ;
        $styledKey = $this->getStyledKey($key);

        if (is_numeric($item)) {
            $this->println(
                $this->nest(
                    sprintf(
                        '"%s"%s %s',
                        $styledKey,
                        $styledColon,
                        Styler::get($this->style->getNumericValueStyle()) . $item . Styler::reset()
                    ),
                    $currentNesting
                )
            );
        } else {
            $this->println(
                $this->nest(
                    sprintf(
                        '"%s"%s "%s"',
                        $styledKey,
                        $styledColon,
                        Styler::get($this->style->getStringValueStyle()) . $item . Styler::reset()
                    ),
                    $currentNesting
                )
            );
        }
    }

    /**
     * Returns styled JSON key
     * Numeric and string keys may have different style
     * @param $key
     * @return string
     */
    protected function getStyledKey($key)
    {
        return is_numeric($key) ?
            $this->getStyled($key, $this->style->getNumericKeyStyle()) :
            $this->getStyled($key, $this->style->getStringKeyStyle());
    }

    /**
     * Returns styled {} / [] brackets
     * @param $item
     * @return array
     */
    protected function getStyledBrackets($item)
    {
        $isNestedArray = is_int(key($item));
        if (true === $isNestedArray) {
            return [
                $this->getStyled('[', $this->style->getSquareBracketStyle()),
                $this->getStyled(']', $this->style->getSquareBracketStyle())
            ];
        } else {
            return [
                $this->getStyled('{', $this->style->getCurlyBracketStyle()),
                $this->getStyled('}', $this->style->getCurlyBracketStyle())
            ];
        }

    }

    /**
     * Max allowed nesting calculation. Zero (or no "nesting" key) mean "no limit"
     * @param $options
     * @return int|null
     */
    protected function getMaxNesting($options)
    {
        $maxNesting = (int) Ar::get($options, 'nesting');
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
     * @return string
     */
    protected function nest($string, $level) {
        return str_pad($string, strlen($string) + $level * 4, ' ', STR_PAD_LEFT);
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
}
