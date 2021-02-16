<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\DataTables;

use CodeIgniter\Format\JSONFormatter;

abstract class DataTableMethods
{
    protected $fields;

    protected $aliases = [];

    protected $totalRecords;

    protected $filteredRecords;

    protected $isFilterApplied = false;

    protected $processColumn = [
        'appends' => [],
        'hidden' => [],
        'raws' => [],
        'edit' => []
    ];

    public function select(String $fields)
    {
        $this->db->select($fields);

        $this->setAliases($fields);
        return $this;
    }

    /**
     * Hide data by deleted_at
     * 
     * @param string name of field
     *               Example: deleted_at
     * Logic, if deleted_at is null
     */
    public function hideDelete(string $field = 'deleted_at')
    {
        $this->db->where($field . ' IS NULL');
        return $this;
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

    public function hideColumns(array $cols)
    {
        $this->processColumn['hidden'] = $cols;

        return $this;
    }

    public function rawColumns(array $cols)
    {
        $this->processColumn['raws'] = $cols;

        return $this;
    }

    public function addColumn(String $name, $callback)
    {
        $this->processColumn['appends'][] = [
            'name' => $name,
            'callback' => $callback
        ];

        return $this;
    }

    public function editColumn(String $name, $callback)
    {
        $this->processColumn['edit'][] = [
            'name' => $name,
            'callback' => $callback
        ];

        return $this;
    }

    protected function render($results, $make)
    {
        $formatter = new JSONFormatter;

        $output = [
            'draw' => $this->request->getDraw(),
            'recordsTotal' => $this->totalRecords,
            'recordsFiltered' => $this->filteredRecords,
            'data' => $results
        ];

        if ($make) {
            return $formatter->format($output);
        }
        return d($output);
    }

    protected function filterRecords()
    {
        if ($this->isFilterApplied) {
            $this->filteredRecords = $this->count();
        } else {
            $this->filteredRecords = $this->totalRecords;
        }
    }

    private function setAliases($fields)
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
