<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\Currency;

use Codenom\Framework\Data\ObjectManager\ObjectManager;

class CurrencyManager
{

    /**
     * @var Codenom\Framework\Data\ObjectManager\ObjectManager
     */
    protected $objectManager;

    public function __construct()
    {
        $this->objectManager = new ObjectManager('currency');
    }

    /**
     * Prepare load Country
     * 
     * @return mixed
     */
    public function getCurrency()
    {
        $this->selectTable();
        return $this;
    }

    /**
     * Get Setting Collection
     * 
     * @return obj
     */
    public function getCollection()
    {
        if (!$found = cache('currencyCollection')) {
            $found = $this->objectManager->load()->getResult();
            cache()->save('currencyCollection', $found, 3600);
        }
        return $found;
    }

    /**
     * Get Currency by id
     * 
     * @param int $id
     * @return obj
     */
    public function getById(int $id)
    {
        if (!$found = cache($id . '_currencyById')) {
            $found = $this->objectManager->where(['id' => $id])->load()->getRow();
            cache()->save($id . '_currencyById', $found, 3600);
        }

        return $found;
    }

    /**
     * Get Currency by Code
     * 
     * @param string $code
     * @return obj
     */
    public function getByCode(string $code)
    {
        if (!$found = cache($code . '_currencyByCode')) {
            $found = $this->objectManager->where(['code' => $code])->load()->getRow();
            cache()->save($code . '_currencyByCode', $found, 3600);
        }

        return $found;
    }

    /**
     * Spesific selecting field/'s table
     * 
     * @param string|array $select
     *                     Example: 'id, name, etc..' or ['id', 'name'].
     *                     Support aliase of name fields table.
     * @return mixed 
     */
    public function select($select)
    {
        $this->objectManager->select($select);
        return $this;
    }

    /**
     * Where
     * 
     * @param string|array $select
     *                     Example: 'id, name, etc..' or ['id', 'name'].
     * @return mixed 
     */
    public function where($where)
    {
        $this->objectManager->where($where);
        return $this;
    }

    /**
     * Currency select table
     * 
     * @var \Codenom\Framework\Data\ObjectManager\ObjectManager
     * @return mixed
     */
    private function selectTable()
    {
        $this->objectManager->select('id as currency_id, title as currency_title, code as currency_code, symbol_left, symbol_right, decimal_places, value as currency_values, status as currency_status, created_at, updated_at, deleted_at');
        return $this;
    }
}
