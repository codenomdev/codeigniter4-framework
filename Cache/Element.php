<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Cache;

class Element
{
    /**
     * Default path cache
     */
    const DEFAULT_PATH = \WRITEPATH . 'generated' . \DIRECTORY_SEPARATOR . 'cache\\';

    /**
     * Type Cache block
     */
    const TYPE_BLOCK = 'block';

    /**
     * Default path cache block
     */
    const PATH_BLOCK = SELF::DEFAULT_PATH . 'block';

    /**
     * Prefix Block
     */
    const PREFIX_BLOCK = 'BLOCK_';

    /**
     * Default Mode
     */
    const MODE = 0640;
}
