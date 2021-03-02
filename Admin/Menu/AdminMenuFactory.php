<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Admin\Menu;

use CodeIgniter\Config\Services;
use Codenom\Framework\Views\Menu\MenuRepository;

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
        return array_merge($this->adminNavbar(), $this->getResult());
    }

    protected function getResult()
    {
        // if (!$found = cache('menuStatic')) {
        $found = (new MenuRepository())->test();
        // cache()->save('menuStatic', $found, 36000);
        // }
        return $found;
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
                'name' => 'Users',
                'label' => 'Users',
                'uri' => '#',
                'attributes' => ['icon' => 'si si-users'],
                'order' => 2,
                'children' => [
                    [
                        'name' => 'User Manage',
                        'label' => 'User Manage',
                        'uri' => admin_url('users/manage'),
                        'order' => 1,
                    ],
                    [
                        'name' => 'User Group',
                        'label' => 'User Group',
                        'uri' => admin_url('users/group'),
                        'order' => 2,
                    ],
                    [
                        'name' => 'Permission',
                        'label' => 'Permission',
                        'uri' => admin_url('users/permission/manage'),
                        'order' => 3,
                    ],
                ]
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
                        'name' => 'Currency',
                        'label' => 'Currency',
                        'uri' => admin_url('setting/currency'),
                        'order' => 2
                    ],
                    [
                        'name' => 'Country',
                        'label' => 'Country',
                        'uri' => admin_url('setting/country'),
                        'order' => 3,
                    ],
                    [
                        'name' => 'Zone',
                        'label' => 'Zone',
                        'uri' => admin_url('setting/zone'),
                        'order' => 4,
                    ]
                ]
            ]
        ];

        return $adminMenuStructure;
    }
}
