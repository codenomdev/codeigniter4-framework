<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\CLI\Templates\Menu;

use Codenom\Framework\Cache\Handlers\FileHandler;
use Codenom\Framework\Views\Menu\MenuRepository;
use Codenom\Framework\Libraries\Menu\Item;

class Generate
{
    /**
     * @var Codenom\Framework\Views\Menu\MenuRepository
     */
    protected $menuRepository;

    /**
     * @var Codenom\Framework\Cache\Handlers\FileHandler
     */
    protected $cache;

    public function __construct()
    {
        $this->cache = new FileHandler(
            new \Codenom\Framework\Views\Templates\Admin\Block\Config\Cache
        );
        $this->menuRepository = new MenuRepository();
    }

    public function generateMenu()
    {
        return $this->generateSerialize();
    }

    private function generateSerialize()
    {
        return \serialize(Item::sort($this->menuRepository->addMenuFactory()));
    }
}
