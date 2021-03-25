<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Routing;

class Element
{
    /**
     * Available method type
     * 
     * @var array
     */
    const TYPE_METHOD = [
        'post', 'get', 'add', 'resource', 'addRedirect', 'put', 'delete', 'match', 'cli', 'head', 'options', 'patch', 'map', 'group'
    ];

    /**
     * Available key
     */
    const AVAILABLE_KEYS = [
        'options', 'namespace', 'controller', 'hostname', 'filter', 'subdomain', 'method', 'as', 'module', 'redirect'
    ];

    /**
     * Default name route
     */
    const NAME_ROUTE = 'route.yaml';

    /**
     * Path Module
     */
    const PATH_MODULE = \APPPATH . 'Code\\';

    /**
     * Admin URL
     */
    const URL_SUFFIX_ADMIN = 'backend';

    /**
     * ID attribute Admin URL Suffix
     * 
     * @var string
     */
    const ATTRIBUTE_BACKEND = 'backend';

    /**
     * ID attribute frontend URL Suffix
     * 
     * @var string
     */
    const ATTRIBUTE_FRONTEND = 'frontend';

    /**
     * Controller path
     * 
     * @var string
     */
    const ADMIN_PATH_CONTROLLERS = '\\Admin\Controllers';
}
