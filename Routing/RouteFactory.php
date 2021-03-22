<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Routing;

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Autoloader\FileLocator;
use Config\Modules;

class RouteFactory extends RouteCollection
{
    /**
     * The namespace to be added to any Controllers.
     * Defaults to the global namespaces (\)
     *
     * @var string
     */
    protected $defaultNamespace = 'App\Controllers\\';

    /**
     * The name of the default controller to use
     * when no other controller is specified.
     *
     * Not used here. Pass-thru value for Router class.
     *
     * @var string
     */
    protected $defaultController = 'Home';

    /**
     * The name of the default method to use
     * when no other method has been specified.
     *
     * Not used here. Pass-thru value for Router class.
     *
     * @var string
     */
    protected $defaultMethod = 'index';

    /**
     * Whether to match URI against Controllers
     * when it doesn't match defined routes.
     *
     * Not used here. Pass-thru value for Router class.
     *
     * @var boolean
     */
    protected $autoRoute = true;

    public function __construct(FileLocator $locator, Modules $moduleConfig)
    {
        parent::__construct($locator, $moduleConfig);
    }

    public function getDefaultNamespace(): string
    {
        return parent::getDefaultNamespace();
    }

    /**
     * Does the heavy lifting of creating an actual route. You must specify
     * the request method(s) that this route will work for. They can be separated
     * by a pipe character "|" if there is more than one.
     *
     * @param string       $verb
     * @param string       $from
     * @param string|array $to
     * @param array|null   $options
     */
    public function create(string $verb, string $from, $to, array $options = null)
    {
        return parent::create($verb, $from, $to, $options);
    }
}
