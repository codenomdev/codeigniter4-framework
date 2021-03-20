<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html;

use Naucon\HtmlBuilder\HtmlElementUniversalAbstract;

class Head extends HtmlElementUniversalAbstract
{
    /**
     * @access      protected
     * @var         string                  html element tag
     */
    protected $tag = Element::TAG_HEAD;

    /**
     * Constructor
     *
     * @param       string      $content    html element content
     */
    public function __construct()
    {
        // parent::setContent($content);
    }
}
