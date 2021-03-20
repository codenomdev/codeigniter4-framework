<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Routing;

class RouteFactory
{
    protected $routeIdentity = null;

    protected $content = [];

    public function setRouteIdentity(string $routeIdentity)
    {
        $this->routeIdentity = $routeIdentity;

        return $this;
    }

    public function getRouteIdentity()
    {
        return $this->routeIdentity;
    }
}
