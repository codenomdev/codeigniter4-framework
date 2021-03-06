<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\DataTables;

use Codenom\Framework\Libraries\DataTables\TableProcessor;
use \Config\Database;

class DataTables
{

    public static function use($table)
    {
        return self::create($table);
    }

    public static function create($table)
    {
        $db = Database::connect();
        return new TableProcessor($db, $table);
    }
}
