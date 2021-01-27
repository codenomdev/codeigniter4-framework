<?php

namespace Codenom\Framework\Admin\Menu;

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
                'current' => admin_url('dashboard')
            ],
            [
                'name' => 'Setting',
                'label' => 'Pengaturan',
                'uri' => '#',
                'attributes' => ['icon' => 'si si-wrench'],
                'order' => 10,
                'children' => [
                    [
                        'name' => 'Country',
                        'label' => 'Country',
                        'uri' => admin_url('setting/country'),
                        'order' => 1,
                        'current' => admin_url('setting/country')
                    ],
                    [
                        'name' => 'Zone',
                        'label' => 'Zone',
                        'uri' => admin_url('setting/zone'),
                        'order' => 2,
                        'current' => admin_url('setting/zone')
                    ]
                ]
            ]
        ];

        return $adminMenuStructure;
    }
}
