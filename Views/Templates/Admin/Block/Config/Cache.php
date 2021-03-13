<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Admin\Block\Config;

use Config\Cache as CacheConfig;
use Codenom\Framework\Cache\Element;

class Cache extends CacheConfig
{
    public $handler = 'file';
    /**
     * Prefix cache
     */
    public $prefix = Element::PREFIX_BLOCK;

    /**
     * Locate path cache block
     */
    public $storePath = Element::PATH_BLOCK;
}
