<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html;

use Naucon\HtmlBuilder\HtmlElementUniversalAbstract;

class Body extends HtmlElementUniversalAbstract
{
    /**
     * @access      protected
     * @var         string                  html element tag
     */
    protected $tag = Element::TAG_BODY;

    /**
     * Constructor
     *
     * @param       string      $content    html element content
     */
    // public function __construct($content = null)
    // {
    //     parent::setContent($content);
    // }
    public function __construct()
    {
    }
}
