<?php

namespace Codenom\Framework\Routing;

use Codenom\Framework\Routing\Loader\XmlFileLoader;
use Config\Services;

class RouteCollection
{
    private $defaults = [];
    private $component = [];
    private $method = [];

    public function __construct(string $file, string $type = null)
    {
        $this->defaults = (new XmlFileLoader())->load($file, $type);
        $this->route = Services::routes();
    }

    public function generateRoute()
    {
        $default = [];
        foreach ($this->defaults as $key => $val) {
            // $this->component = $this->getMethod($val['_route']['_methods']);
            // if (is_array($val['_route']['_methods']) && array_key_exists('_methods', $val['_route'])) {
            $this->getMethod($val['_route']['_methods']);
            //     // $default[] = $val['_route']['_methods'];
            // }
        }
        // return $this;
        // return $default;
    }

    private function getMethod($method)
    {
        foreach ($method as $key => $val) {
            if ($val == 'add') {
                $this->route->{$val}('test', 'Test::index');
            }
        }

        return $this->route;
    }

    // private function getController($controller)
    // {
    //     $this->component['_controller'][] = $controller;
    //     return $this;
    // }

    // private function getPaths($paths)
    // {
    //     $this->component['_paths'][] = $paths;
    //     return $this;
    // }
}
