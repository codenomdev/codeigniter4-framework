<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Page;

use Codenom\Framework\Views\Templates\Build\Html\Element;
use Codenom\Framework\Views\Templates\Build\Html\Meta\Author;
use Codenom\Framework\Views\Templates\Build\Html\Meta\Charset;
use Codenom\Framework\Views\Templates\Build\Html\Meta\Description;
use Codenom\Framework\Views\Templates\Build\Html\Meta\Keywords;
use Codenom\Framework\Views\Templates\Build\Html\Meta\Robots;
use Codenom\Framework\Views\Templates\Build\Html\Meta\Title;
use Codenom\Framework\Views\Templates\Build\Layout\LayoutAbstract;
use Codenom\Framework\Views\Templates\Build\Layout\Item;

class Head extends LayoutAbstract
{
    protected $tag = Element::TAG_HEAD;
    protected $order = 0;

    public function __construct()
    {
        // $this->metaCharset = new Charset();
        // $this->metaTitle = new Title();
        // $this->metaRobots = new Robots();
        // $this->metaKeywords = new Keywords();
        // $this->metaDescription = new Description();
        // $this->metaAuthor = new Author();
    }

    public function build($element)
    {
        return parent::addChildElement($element);
    }
    // public function build(LayoutAbstract $element)
    // {
    //     return Item::sort(parent::addChildElement($element));
    // }

    public function setTitle($title)
    {
        $metaTitle = new Title();
        return $this->build($metaTitle->set($title));
    }

    public function setRobots($index = Element::META_INDEX_ROBOTS_STATUS, $follow = Element::META_INDEX_ROBOTS_STATUS)
    {
        $metaRobots = new Robots();
        return $this->build($$metaRobots->set($index, $follow));
    }

    public function setKeywords($keywords = null)
    {
        $metaKeywords = new Keywords();
        if (!$keywords) {
            return;
        }
        return $this->build($metaKeywords->setContent($keywords));
    }

    public function setDescription(string $content = null)
    {
        $metaDescription = new Description();
        if (!$content) {
            return;
        }
        return $this->build($metaDescription->set($content));
    }

    public function setAuthor(string $content = null)
    {
        $metaAuthor = new Author();
        if (!$content) {
            return;
        }

        return $this->build($metaAuthor->set($content));
    }

    public function setCharset(string $charset = Element::DEFAULT_CHARSET)
    {
        $metaCharset = new Charset();
        return $this->build($metaCharset->set($charset));
    }
}
