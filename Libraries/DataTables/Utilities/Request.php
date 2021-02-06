<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\DataTables\Utilities;

use CodeIgniter\Config\Services;

class Request
{

    /**
     * @var CodeIgniter\Config\Services::request
     */
    private $request;

    public function __construct()
    {
        $this->request = Services::request();
    }

    public function getColumns()
    {
        $cols = $this->get('columns');

        return $cols ?? null;
    }

    public function getKeyword()
    {
        $search = esc($this->get('search'));

        return $search['value'] ?? null;
    }

    public function getLimiting()
    {
        $data = [
            'limit' => intval($this->get('length') ?? 10),
            'offset' => (int) $this->get('start')
        ];

        return $data;
    }

    public function getDraw()
    {
        return (int) $this->get('draw');
    }

    public function getOrdering()
    {
        if (isset($this->get('order')[0])) {
            $field = esc($this->get('order')[0]['column'] ?? '');
            $ascDsc = esc($this->get('order')[0]['dir'] ?? '');

            if (isset($this->get('columns')[$field])) {
                $column = esc($this->get('columns')[$field]['data'] ?? '');
            } else {
                $column = '';
            }
        } else {
            $column = '';
            $ascDsc = 'ASC';
        }

        return [
            'column' => $column,
            'sort' => $ascDsc
        ];
    }

    private function get($name = '')
    {
        return $this->request->getGet($name);
    }
}
