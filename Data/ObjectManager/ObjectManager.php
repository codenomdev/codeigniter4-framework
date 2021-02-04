<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\ObjectManager;

use Codenom\Framework\Models\DB;

class ObjectManager implements ObjectManagerInterface
{
    protected $db;
    protected $fields;
    protected $aliases = [];

    public function __construct($table = '')
    {
        $this->db = DB::use($table);
    }

    public function where(array $data)
    {
        $this->db->where($data);

        return $this;
    }

    public function join($table, $cond, $type = '')
    {
        $this->db->join($table, $cond, $type);

        return $this;
    }

    public function select(string $fields)
    {
        $this->db->select($fields);
        $this->setAliases($fields);
        return $this;
    }

    /**
     * Load data
     * 
     * @return mixed
     */
    public function load()
    {
        return $this->db->get();
    }

    public function ordering($order)
    {
        $this->db->orderBy($order);
        return $this;
    }

    public function limiting($limit)
    {
        $this->db->limit($limit);
        return $this;
    }

    public function groupStart()
    {
        $this->db->groupStart();
        return $this;
    }

    public function groupEnd()
    {
        $this->db->groupEnd();
        return $this;
    }

    public function orGroupStart()
    {
        $this->db->orGroupStart();
        return $this;
    }

    public function groupBy($group)
    {
        $this->db->groupBy($group);
        return $this;
    }

    public function having($having)
    {
        $this->db->having($having);
        return $this;
    }

    public function setAliases($fields): bool
    {
        foreach (explode(',', $fields) as $val) {
            if (stripos($val, 'as')) {
                $alias = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
                $field = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', $val));

                $this->aliases[$alias] = $field;
            }
        }

        return true;
    }
}
