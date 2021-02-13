<?php

namespace Codenom\Framework\Components;

use CodeIgniter\Autoloader\FileLocator;
use CodeIgniter\Config\Services;

class DirSearch
{
    /**
     * @var \CodeIgniter\Autoloader\FileLocator
     */
    protected $loader;

    public function __construct()
    {
        $this->loader = Services::locator();
    }
}
