<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html\Meta;

use Codenom\Framework\Views\Templates\Build\Layout\LayoutAbstract;
use Codenom\Framework\Views\Templates\Build\Html\Element;

class Title extends LayoutAbstract
{
    /**
     * @access      protected
     * @var         string                  html element tag
     */
    protected $tag = Element::TAG_TITLE;

    /**
     * Default title glue
     */
    const TITLE_GLUE = ' / ';

    /**
     * Set Default title
     */
    const DEFAULT_TITLE = 'Codenom';

    /**
     * Set default order
     */
    protected $order = 1;

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
        $this->textValue = parent::setContent(\esc($title));
        return $this;
    }

    public function getDefaultTitle($prefix = 'Backend')
    {
        $this->textValue = parent::setContent(SELF::DEFAULT_TITLE . SELF::TITLE_GLUE . $prefix);
        return $this;
    }

    /**
     * Unset title
     *
     * @return void
     */
    public function unsetValue()
    {
        $this->textValue = parent::setContent('');
        return $this;
    }
}
