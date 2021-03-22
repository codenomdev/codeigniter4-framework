<?php

namespace Codenom\Framework\Controllers;

use CodeIgniter\Controller;

abstract class TestController extends Controller
{
    public function __construct()
    {
        $this->_method                                = service('router')->methodName();
        $this->path                                        = (isset(service('router')->getMatchedRoute()[0]) ? service('router')->getMatchedRoute()[0] : null);
        return $this->path;
    }
}
