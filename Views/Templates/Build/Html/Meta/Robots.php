<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html\Meta;

use Codenom\Framework\Views\Templates\Build\Html\Element;
use Codenom\Framework\Views\Templates\Build\Layout\LayoutAbstract;
use Naucon\HtmlBuilder\HtmlElementUniversalAbstract;

/**
 * Html Meta Robots Class
 */
class Robots extends MetaFactory
{
    // protected $tag = Element::TAG_META;
    protected $order = 2;

    private $textValue;

    public function set($index = Element::META_INDEX_ROBOTS_STATUS, $follow = Element::META_FOLLOW_ROBOTS_STATUS)
    {
        $content = (($index) ? Element::META_VALUE_INDEX : Element::META_VALUE_NOINDEX) . ',' . (($follow) ? Element::META_VALUE_FOLLOW : Element::META_VALUE_NOFOLLOW);
        $this->textValue = $content;
        parent::setName(Element::TAG_ROBOTS);
        return parent::setContent($this->textValue);
    }
}
