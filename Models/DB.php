<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models;

use \Config\Database;

class DB implements DBInterface
{
    public static function use($table)
    {
        return SELF::create($table);
    }

    public static function create($table)
    {
        $db = Database::connect();
        return $db->table($table);
    }
}
