<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

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

    public function testArray()
    {
        return [
            'backend' => [
                'get' => [
                    [
                        'from' => 'dashboard',
                        'to' => 'Dashboard::index',
                        'option' => [
                            'namespace' => 'Codenom\Dashboard\Admin\Controller',
                            'as' => 'test',
                            'filter' => 'backend'
                        ]
                    ]
                ]
            ]
        ];
    }
}
