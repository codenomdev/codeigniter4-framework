<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config;

interface ScopeConfigInterface
{
    /**
     * Default scope type
     */
    const SCOPE_TYPE_DEFAULT = 'default';

    /**
     * Retrieve config value by path and scope.
     *
     * @param string $path The path through the tree of configuration values, e.g., 'general/store_information/name'
     * @param string $scopeType The scope to use to determine config value, e.g., 'store' or 'default'
     * @param null|int|string $scopeCode
     * @return mixed
     */
    public function getValue($path, $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null);

    /**
     * Retrieve config flag by path and scope
     *
     * @param string $path The path through the tree of configuration values, e.g., 'general/store_information/name'
     * @param string $scopeType The scope to use to determine config value, e.g., 'store' or 'default'
     * @param null|int|string $scopeCode
     * @return bool
     */
    public function isSetFlag($path, $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null);
}
