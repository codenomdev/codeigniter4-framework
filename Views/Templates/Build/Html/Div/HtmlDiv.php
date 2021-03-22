<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html\Div;

use Naucon\HtmlBuilder\HtmlElementUniversalAbstract;
use Codenom\Framework\Views\Templates\Build\Html\Element;

class HtmlDiv extends HtmlElementUniversalAbstract
{
    /**
     * @access      protected
     * @var         string                  html element tag
     */
    protected $tag = Element::TAG_DIV;

    /**
     * Constructor
     *
     * @param       string      $content    html element content
     */
    public function __construct($content = null)
    {
        parent::setContent($content);
    }

    /**
     * @param       array   $attributes     html element attributes with key-value-pairs
     * @return      HtmlElementAbstract
     */
    public function setAttribute($key, $value = null)
    {
        return parent::setAttribute($key, $value);
    }

    /**
     * @return      string                  html element attribute class
     */
    public function getClass()
    {
        return parent::getClass();
    }

    /**
     * @param       string      $class      html element attribute class
     * @return      HtmlElementUniversalAbstract
     */
    public function setClass($class)
    {
        return parent::setAttribute(Element::SET_CLASS, $class);
    }

    /**
     * @return      string                  html element attribute style
     */
    public function getStyle()
    {
        return parent::getAttribute(Element::SET_STYLE);
    }

    /**
     * @param       string      $style      html element attribute style
     * @return      HtmlElementUniversalAbstract
     */
    public function setStyle($style)
    {
        return parent::setAttribute(Element::SET_STYLE, $style);
    }

    /**
     * @return      string                  html element attribute title
     */
    public function getTitle()
    {
        return parent::getAttribute(Element::TAG_TITLE);
    }

    /**
     * @param       string      $title      html element attribute title
     * @return      HtmlElementUniversalAbstract
     */
    public function setTitle($title)
    {
        return parent::setAttribute(Element::TAG_TITLE, $title);
    }

    /**
     * @return      string                  html element attribute onclick
     */
    public function getOnClick()
    {
        return parent::getAttribute(Element::ONCLICK);
    }

    /**
     * @param       string      $event      html element attribute onclick
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnClick($event)
    {
        return parent::setAttribute(Element::ONCLICK, $event);
    }

    /**
     * @return      string                  html element attribute ondblclick
     */
    public function getOnDoubleClick()
    {
        return parent::getAttribute(Element::ON_DOUBLE_CLICK);
    }

    /**
     * @param       string      $event      html element attribute ondblclick
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnDoubleClick($event)
    {
        return parent::setAttribute(Element::ON_DOUBLE_CLICK, $event);
    }

    /**
     * @return      string                  html element attribute onmousedown
     */
    public function getOnMouseDown()
    {
        return parent::getAttribute(Element::ON_MOUSE_DOWN);
    }

    /**
     * @param       string      $event      html element attribute onmousedown
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnMouseDown($event)
    {
        return parent::setAttribute(Element::ON_MOUSE_DOWN, $event);
    }

    /**
     * @return      string                  html element attribute onmouseup
     */
    public function getOnMouseUp()
    {
        return parent::getAttribute(Element::ON_MOUSE_UP);
    }

    /**
     * @param       string      $event      html element attribute onmouseup
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnMouseUp($event)
    {
        return parent::setAttribute(Element::ON_MOUSE_UP, $event);
    }

    /**
     * @return      string                  html element attribute onmouseover
     */
    public function getOnMouseOver()
    {
        return parent::getAttribute(Element::ON_MOUSE_OVER);
    }

    /**
     * @param       string      $event      html element attribute onmouseover
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnMouseOver($event)
    {
        return parent::setAttribute(Element::ON_MOUSE_OVER, $event);
    }

    /**
     * @return      string                  html element attribute onmousemove
     */
    public function getOnMouseMove()
    {
        return parent::getAttribute(Element::ON_MOUSE_MOVE);
    }

    /**
     * @param       string      $event      html element attribute onmousemove
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnMouseMove($event)
    {
        return parent::setAttribute(Element::ON_MOUSE_MOVE, $event);
    }

    /**
     * @return      string                  html element attribute onmouseout
     */
    public function getOnMouseOut()
    {
        return parent::getAttribute(Element::ON_MOUSE_OUT);
    }

    /**
     * @param       string      $event      html element attribute onmouseout
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnMouseOut($event)
    {
        return parent::setAttribute(Element::ON_MOUSE_OUT, $event);
    }

    /**
     * @return      string                  html element attribute onkeypress
     */
    public function getOnKeyPress()
    {
        return parent::getAttribute(Element::ON_KEYPRESS);
    }

    /**
     * @param       string      $event      html element attribute onkeypress
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnKeyPress($event)
    {
        return parent::setAttribute(Element::ON_KEYPRESS, $event);
    }

    /**
     * @return      string                  html element attribute onkeydown
     */
    public function getOnKeyDown()
    {
        return parent::getAttribute(Element::ON_KEYDOWN);
    }

    /**
     * @param       string      $event      html element attribute onkeydown
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnKeyDown($event)
    {
        return parent::setAttribute(Element::ON_KEYDOWN, $event);
    }

    /**
     * @return      string                  html element attribute onkeyup
     */
    public function getOnKeyUp()
    {
        return parent::getAttribute(Element::ON_KEYUP);
    }

    /**
     * @param       string      $event      html element attribute onkeyup
     * @return      HtmlElementUniversalAbstract
     */
    public function setOnKeyUp($event)
    {
        return parent::setAttribute(Element::ON_KEYUP, $event);
    }
}
