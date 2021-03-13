<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Config;

class Title
{
    /**
     * Default title glue
     */
    const TITLE_GLUE = ' / ';

    /**
     * @var string[]
     */
    private $prependedValues = [];

    /**
     * @var string[]
     */
    private $appendedValues = [];

    /**
     * @var string
     */
    private $textValue;

    /**
     * Set page title
     *
     * @param string $title
     * @return $this
     */
    public function set($title)
    {
        $this->textValue = $title;
        return $this;
    }

    /**
     * @param string $suffix
     * @return void
     */
    public function append($suffix)
    {
        $this->appendedValues[] = $suffix;
    }

    /**
     * @param string $prefix
     * @return void
     */
    public function prepend($prefix)
    {
        array_unshift($this->prependedValues, $prefix);
    }

    /**
     * Unset title
     *
     * @return void
     */
    public function unsetValue()
    {
        $this->textValue = null;
    }

    /**
     * @param bool $withConfigValues
     * @return array
     */
    protected function build($withConfigValues = true)
    {
        return array_merge(
            $this->prependedValues,
            [$withConfigValues ? $this->addConfigValues($this->textValue) : $this->textValue],
            $this->appendedValues
        );
    }

    /**
     * @param string $title
     * @return string
     */
    protected function addConfigValues($title)
    {
        $preparedTitle = 'Test / ' . $title;
        return trim($preparedTitle);
    }

    /**
     * Retrieve title element text (encoded)
     *
     * @return string
     */
    public function get()
    {
        return join(self::TITLE_GLUE, $this->build());
    }

    /**
     * Same as getTitle(), but return only first item from chunk
     *
     * @return mixed
     */
    public function getShort()
    {
        $title = $this->build();
        return reset($title);
    }

    /**
     * Same as getShort(), but return title without prefix and suffix
     * @return mixed
     */
    public function getShortHeading()
    {
        $title = $this->build(false);
        return reset($title);
    }

    /**
     * Retrieve default title text
     *
     * @return string
     */
    public function getDefault()
    {
        $defaultTitle = 'Codenom';
        return $this->addConfigValues($defaultTitle);
    }
}
