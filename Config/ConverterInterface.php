<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config;

/**
 * Config DOM-to-array converter interface.
 *
 * @api
 * @since 100.0.2
 */
interface ConverterInterface
{
    /**
     * Convert config
     *
     * @param $source
     * @return array
     */
    public function convert($source);
}
