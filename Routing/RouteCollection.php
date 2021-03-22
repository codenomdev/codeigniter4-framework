<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Routing;

use Config\Services;
// use CodeIgniter\Router\RouteCollection as CIRoute;
use Codenom\Framework\Routing\Loader\Loader;

class RouteCollection
{
    public function __construct(RouteFactory $route = null)
    {
        $this->route = $route;
        $this->loadFromYaml();
        return $this->route;
    }

    protected function loadFromYaml()
    {
        $this->route = (new Loader())->load('Codenom\Dashboard\Admin\Config\route.yaml');
        return $this->route;
    }
}
