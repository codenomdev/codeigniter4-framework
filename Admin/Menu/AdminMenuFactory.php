<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Admin\Menu;

class AdminMenuFactory extends \Codenom\Framework\Libraries\Menu\MenuFactory
{
    protected $rootItemName = 'Admin Menu';
    protected $bodyHtml = '';

    public function adminMenu()
    {
        $menuStructure = $this->getAdminMenu();
        return $this->loader->load($this->buildMenuStructure($menuStructure));
    }

    protected function getAdminMenu()
    {
        return array_merge($this->adminNavbar(), $this->getSettingMenu());
    }

    public function getSettingMenu()
    {
        $children = array(
            array(
                'name' => 'Setting',
                'label' => 'Pengaturan',
                'uri' => '#',
                'attributes' => ['icon' => 'si si-wrench'],
                'order' => 10,
            )
        );

        return $children;
    }

    public function adminNavbar()
    {
        $adminMenuStructure = [
            [
                'name' => 'Dashboard',
                'label' => 'Dashboard',
                'uri' => admin_url('dashboard'),
                'attributes' => ['icon' => 'si si-speedometer'],
                'order' => 1,
            ],
        ];

        return $adminMenuStructure;
    }
}
