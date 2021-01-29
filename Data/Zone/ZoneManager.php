<?php

namespace Codenom\Framework\Data\Zone;

use Codenom\Framework\Data\ObjectManager\ObjectManager;

class ZoneManager
{
    protected $objectManager;

    public function __construct()
    {
        $this->objectManager = new ObjectManager('zone');
    }

    /**
     * Prepare load Zone
     * 
     * @return mixed
     */
    public function getZone()
    {
        $this->selectTable();
        return $this;
    }

    /**
     * Get Zone by ID Zone
     * 
     * @param int $id
     * @return obj
     */
    public function getById(int $id)
    {
        if (!$found = cache($id . '_zoneData')) {
            $found = $this->objectManager->where(['id' => $id])->load()->getRow();
            cache()->save($id . '_zoneData', $found, 3600);
        }
        return $found;
    }

    /**
     * Get zone by ID Country
     * 
     * @param int $id
     * @return obj
     */
    public function getByIdCountry(int $id)
    {
        return $this->objectManager->where(['country_id' => $id])->load()->getResult();
    }

    /**
     * Get zone by Code Zone
     * 
     * @param string $code
     * @return obj
     */
    public function getByCode(string $code)
    {
        return $this->objectManager->where(['code' => $code])->load()->getRow();
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
     * Zone select table
     * 
     * @var \Codenom\Framework\Data\ObjectManager\ObjectManager
     * @return mixed
     */
    private function selectTable()
    {
        $this->objectManager->select('id as zone_id, country_id, name, code, status');
        return $this;
    }
}
