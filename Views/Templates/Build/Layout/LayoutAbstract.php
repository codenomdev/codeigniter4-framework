<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Layout;

use Naucon\HtmlBuilder\HtmlElementAbstract;
use Naucon\HtmlBuilder\HtmlElementUniversalAbstract;
use Naucon\HtmlBuilder\HtmlElementInterface;

abstract class LayoutAbstract extends HtmlElementAbstract
{
    /**
     * @access      protected
     * @var         string                  html element tag
     */
    protected $tag = null;

    /**
     * @access      protected
     * @var         Map                     html element attributes with key-value-pairs
     */
    protected $attributeMap = null;

    /**
     * @access      protected
     * @var         Collection              child element collection
     */
    protected $childElementCollection = null;

    protected $order = null;

    public function getTag()
    {
        return parent::getTag();
    }

    public function getAttributes()
    {
        return parent::getAttributes();
    }

    public function setAttributes(array $attributes)
    {
        return parent::setAttributes($attributes);
    }

    public function getAttribute($key)
    {
        return parent::getAttribute($key);
    }

    public function hasAttribute($key)
    {
        return parent::hasAttribute($key);
    }

    public function setAttribute($key, $value = null)
    {
        return parent::setAttribute($key, $value);
    }

    public function removeAttribute($key)
    {
        parent::removeAttribute($key);
    }

    public function getChildElementCollection()
    {
        return parent::getChildElementCollection();
    }

    public function getChildElements()
    {
        return parent::getChildElements();
    }

    public function hasChildElements()
    {
        return parent::hasChildElements();
    }

    public function setChildElements(array $elements)
    {
        return parent::setChildElements($elements);
    }

    public function addChildElement(HtmlElementInterface $element)
    {
        return parent::addChildElement($element);
    }

    public function setContent($content)
    {
        return parent::setContent($content);
    }

    public function addContent($content = null)
    {
        return parent::addContent($content);
    }

    public function setOrder($order)
    {
        $this->order = (int) $order;
        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return      string                  html element attribute id
     */
    public function getId()
    {
        return parent::getAttribute('id');
    }

    /**
     * @return      string                  html element attribute class
     */
    public function getClass()
    {
        return parent::getAttribute('class');
    }

    // public static function sort(HtmlElementInterface $item, $sortChildren = true)
    // {
    //     if ($sortChildren) {
    //         if ($item->hasChildElements()) {
    //             foreach ($item->getChildElementCollection() as $i => $child) {
    //                 $children[$i] = static::sort($child);
    //             }
    //         }
    //     }

    //     return $children;
    // }
}
