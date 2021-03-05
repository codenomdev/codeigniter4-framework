<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Menu;

use Codenom\Framework\Admin\Menu\AdminMenuFactory;
use Codenom\Framework\Views\Menu\Element;

class MenuRepository
{
    /**
     * @var \Codenom\Framework\Views\Menu\MenuFactory
     */
    protected $menuFactory;

    /**
     * @var \Codenom\Framework\Admin\Menu\AdminMenuFactory
     */
    protected $adminMenuFactory;

    /**
     * Constructor Class
     */
    public function __construct()
    {
        $this->menuFactory = new MenuFactory();
        $this->adminMenuFactory = (new AdminMenuFactory())->adminMenu();
    }

    public function addMenuFactory()
    {
        $adminMenu = $this->adminMenuFactory;
        foreach ($this->menuFactory->getMenuFromLoader() as $key => $value) {
            switch ($value['_method']) {
                case Element::METHOD_ADD:
                    $adminMenu = $this->addMenu($value);
                    break;
                case Element::METHOD_CHILDREN:
                    $adminMenu = $this->createChildren($value['content']);
                    break;
                case Element::METHOD_UPDATE:
                    $adminMenu = $this->updateMenu($value);
                    break;
                default:
                    throw new \InvalidArgumentException(sprintf('Unknown method "%s" used in file "menu.xml". Expected "add", "children", "update, or "remove".', $value['_method']));
                    break;
            }
        }

        return $adminMenu;
    }

    protected function addMenu(array $data = [])
    {
        if ($data['_parent'] !== '') {
            if (!\is_null($this->adminMenuFactory->getChild($data['_parent']))) {
                $this->adminMenuFactory->getChild($data['_parent'])->addChild($data['name'], $data);
            }
        }
        $this->adminMenuFactory->addChild($data['name'], $data);

        return $this->adminMenuFactory;
    }
    protected function updateMenu($data)
    {
        if ($data['_parent'] !== '' && $this->adminMenuFactory->getChild($data['_parent'])) {
            if (isset($data['attributes'])) {
                $this->adminMenuFactory->getChild($data['_parent'])->setAttributes($data['attributes']);
            }
            $this->adminMenuFactory->getChild($data['_parent'])
                ->setName($data['name'])
                ->setLabel($data['label'])
                ->setOrder($data['order'])
                ->setIcon($data['icon'])
                ->setUri($data['uri']);
        }

        return $this->adminMenuFactory;
    }

    protected function createChildren($data)
    {
        $this->adminMenuFactory->addChild($data['name'], [
            'name' => $data['name'],
            'label' => $data['label'],
            'attributes' => $data['attributes']
        ]);
        foreach ($data['children'] as $key => $value) {
            if (!\is_null($this->adminMenuFactory->getChild($data['name']))) {
                $this->adminMenuFactory->getChild($data['name'])->addChild($value['name'], $value);
            }
        }
        return $this->adminMenuFactory;
    }
}
