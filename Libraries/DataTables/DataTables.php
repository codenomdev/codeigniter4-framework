<?php

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
