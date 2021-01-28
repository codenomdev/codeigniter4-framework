<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Menu;

class MenuFactory extends \Knp\Menu\MenuFactory
{
    protected $loader = NULL;
    protected $rootItemName = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->loader = new \Knp\Menu\Loader\ArrayLoader($this);
    }

    public function createItem($name, array $options = array())
    {
        $extension = new Factory\CodenomExtension();
        $options = $extension->buildOptions($options);
        $item = parent::createItem($name, $options);
        $item = unserialize(sprintf("O:%d:\"%s\"%s", strlen("Codenom\\Framework\\Libraries\Menu\Item"), "Codenom\\Framework\\Libraries\Menu\Item", strstr(strstr(serialize($item), "\""), ":")));
        $extension->buildItem($item, $options);
        return $item;
    }

    protected function buildMenuStructure(array $structure = array())
    {
        return array("name" => $this->rootItemName, "children" => $structure);
    }

    public function emptySidebar()
    {
        return $this->loader->load($this->buildMenuStructure());
    }

    public function getLoader()
    {
        return $this->loader;
    }
}
