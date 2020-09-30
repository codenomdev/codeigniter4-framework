<?php

namespace Codenom\Framework\Libraries\Backend\Menu\Contracts;

use Codenom\Framework\Libraries\Backend\Menu\ItemCollection;

interface Renderer
{
    /**
     * Renders the menu.
     * @param ItemCollection $itemCollection
     * @param mixed $parentId
     * @return string
     */
    public function generate(ItemCollection $itemCollection, $parentId = null): string;
}
