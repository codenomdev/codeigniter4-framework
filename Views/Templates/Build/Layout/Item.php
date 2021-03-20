<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Layout;

use Naucon\HtmlBuilder\HtmlBuilder;
use Naucon\HtmlBuilder\HtmlElementInterface;
use Naucon\HtmlBuilder\HtmlElementContent;

class Item extends HtmlBuilder
{
    public static function sort(HtmlElementInterface $item, $sortChildren = true)
    {
        // $children = $item->getChildElementCollection();
        $children = [];
        if ($sortChildren) {
            foreach ($item->getChildElementCollection() as $i => $child) {
                if ($child instanceof HtmlElementContent) {
                    $children[$i] = Item::sort($child->getTag());
                }
            }
        }
        // uasort(
        //     $children,
        //     function (HtmlElementInterface $a, HtmlElementInterface $b) {
        //     }
        // );
        return $children;
    }
}
