<?php

namespace Codenom\Framework\Views\Menu;

use Codenom\Framework\Views\Menu\Loader\XmlFileLoader;

class MenuRepository
{
    /**
     * @var Codenom\Framework\Views\Menu\MenuGenerate
     */
    protected $menuGenerate;

    /**
     * @var Codenom\Framework\Views\Menu\XmlFileLoader
     */
    protected $menuLoader;
    private $content = [];

    public function __construct()
    {
        $this->menuGenerate = new MenuGenerate();
        $this->menuLoader = new XmlFileLoader();
    }

    public function test()
    {
        // foreach ($this->loader() as $key => $value) {
        //     $content[] = $this->extractMenu($value);
        // }

        return \array_merge($this->menuAdd(), $this->menuChildren());
    }

    protected function extractMenu(array $data = [])
    {
        $menu = [];
        if (!is_array($data)) {
            return false;
        }
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                // $menuAdd[] = $v;
                $menu[] = [$this->menuChildren($v)];
            }
        }

        return $menu;
    }

    public function menuChildren()
    {
        $children = [];
        foreach ($this->loader() as $key => $value) {
            foreach ($value as $k => $v) {
                if (\is_array($v) && (\array_key_exists('_parents', $v) === true)) {
                    $children[$key] = $v['_parents'];
                }
            }
        }

        return $children;
    }

    public function menuAdd(array $data = [])
    {
        $menu = [];
        foreach ($this->loader() as $k => $value) {
            foreach ($value as $k => $v) {
                if (\is_array($v) && (\array_key_exists('_add', $v) === true)) {
                    if ($v['_add']['_parent'] !== '') {
                        $menu[] = $v['_add'];
                    }
                }
            }
        }

        return $menu;
    }

    private function loader()
    {
        $content = [];
        foreach (glob(\APPPATH . 'Code\\*\\*\\', \GLOB_ONLYDIR) as $itemDir) {
            $getFile = $itemDir . 'Admin\\Config\\menu.xml';
            $isRealPath = str_replace('\\', '/', $getFile);
            if ($this->menuGenerate->isFile($isRealPath)) {
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
