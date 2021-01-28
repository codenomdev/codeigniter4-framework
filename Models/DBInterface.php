<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models;

interface DBInterface
{
    /**
     * Use table name
     * 
     * @param string $table
     * @return mixed
     */
    public static function use($table);

    /**
     * Create table name
     * 
     * @param string $table;
     * @return mixed
     */
    public static function create($table);
}
