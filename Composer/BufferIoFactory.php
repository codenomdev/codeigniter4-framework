<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Composer;

use Composer\IO\BufferIO;

/**
 * Class creates BufferIO instance
 */
class BufferIoFactory
{
    /**
     * Creates BufferIO instance
     *
     * @return BufferIO
     */
    public function create()
    {
        return new BufferIO();
    }
}
