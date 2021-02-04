<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Admin\Menu;

use CodeIgniter\Config\Services;

class AdminMenuFactory extends \Codenom\Framework\Libraries\Menu\MenuFactory
{
    protected $rootItemName = 'Admin Menu';

    public function adminMenu()
    {
        $menuStructure = $this->getAdminMenu();
        return $this->loader->load($this->buildMenuStructure($menuStructure));
    }

    protected function getAdminMenu()
    {
        return array_merge($this->adminNavbar());
    }

    protected function adminNavbar()
    {
        $adminMenuStructure = [
            [
                'name' => 'Dashboard',
                'label' => 'Dashboard',
                'uri' => admin_url('dashboard'),
                'attributes' => ['icon' => 'si si-speedometer'],
                'order' => 1,
            ],
            [
                'name' => 'Setting',
                'label' => 'Pengaturan',
                'uri' => '#',
                'attributes' => ['icon' => 'si si-wrench'],
                'order' => 10,
                'children' => [
                    [
                        'name' => 'General',
                        'label' => 'General',
                        'uri' => admin_url('setting'),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Country',
                        'label' => 'Country',
                        'uri' => admin_url('setting/country'),
                        'order' => 2,
                    ],
                    [
                        'name' => 'Zone',
                        'label' => 'Zone',
                        'uri' => admin_url('setting/zone'),
                        'order' => 3,
                    ]
                ]
            ]
        ];

        return $adminMenuStructure;
    }
}
