<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Admin\Block;

use Codenom\Framework\Views\Menu\MenuRepository;
use Codenom\Framework\Libraries\Menu\Item;

class Menu
{
    /**
     * @var \Codenom\Framework\Views\Menu\MenuRepository
     */
    private $menuFactory;

    /**
     * @var Codenom\Framework\Libraries\Menu\Item
     */
    private $sort;

    /**
     * Constructor Class
     * 
     * @var $menuFactory
     */
    public function __construct()
    {
        $this->menuFactory = new MenuRepository();
        $this->sort = $this->sort();
    }

    /**
     * Render Menu sidebar
     * 
     * @var $menuFactory
     * @return string renderer template
     */
    public function menuFactory()
    {
        return view('Codenom\\Framework\\Views\\Templates\\Admin\\Html\\menu_sidebar', ['adminMenu' => \serialize($this->sort)]);
    }

    /**
     * Sort menu array
     * 
     * @var $menuFactory
     * @return mixed string|array|object
     */
    private function sort()
    {
        return Item::sort($this->menuFactory->addMenuFactory());
    }
}
