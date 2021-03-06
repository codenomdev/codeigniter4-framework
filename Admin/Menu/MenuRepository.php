<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Admin\Menu;

class MenuRepository
{
    protected $primaryNavbar = null;
    protected $adminMenu = null;

    public function __construct(PrimaryNavbarFactory $navbarFactory, AdminMenuFactory $adminMenuFactory)
    {
        $this->setPrimaryNavbarFactory($navbarFactory)->setAdminMenuFactory($adminMenuFactory);
    }

    protected function setPrimaryNavbarFactory(PrimaryNavbarFactory $navbarFactory)
    {
        $this->primaryNavbarFactory = $navbarFactory;
        return $this;
    }

    public function primaryNavbar()
    {
        if (is_null($this->primaryNavbar)) {
            $this->primaryNavbar = $this->primaryNavbarFactory->navbar();
        }

        return $this->primaryNavbar;
    }

    protected function setAdminMenuFactory(AdminMenuFactory $adminFactory)
    {
        $this->adminMenuFactory = $adminFactory;
        return $this;
    }

    public function adminMenu()
    {
        if (is_null($this->adminMenu)) {
            $this->adminMenu = $this->adminMenuFactory->adminMenu();
        }
        return $this->adminMenu;
    }
}
