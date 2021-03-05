<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Menu;

use Codenom\Framework\Views\Menu\Loader\XmlFileLoader;
use Codenom\Framework\Drive\File;

class MenuFactory
{
    /**
     * @var Codenom\Framework\Drive\File
     */
    protected $fileLoader;

    /**
     * @var Codenom\Framework\Views\Menu\XmlFileLoader
     */
    protected $menuLoader;

    /**
     * @var Codenom\Framework\Libraries\Menu\Item
     */
    protected $menuItem;

    private $content = [];

    public function __construct()
    {
        $this->fileLoader = new File();
        $this->menuLoader = new XmlFileLoader();
    }

    public function getMenuFromLoader()
    {
        $menuLoader = [];
        foreach ($this->loader() as $k => $value) {
            foreach ($value as $k => $v) {
                $menuLoader[] = $v;
            }
        }

        return $menuLoader;
    }

    private function loader()
    {
        foreach (glob(\APPPATH . 'Code\\*\\*\\', \GLOB_ONLYDIR) as $itemDir) {
            $getFile = $itemDir . 'Admin\\Config\\menu.xml';
            $isRealPath = str_replace('\\', '/', $getFile);
            if ($this->fileLoader->isFile($isRealPath)) {
                $this->content[] = $this->getMenuLoader($isRealPath);
            }
        }
        return $this->content;
    }

    private function getMenuLoader($path)
    {
        return $this->menuLoader->load($path);
    }
}
