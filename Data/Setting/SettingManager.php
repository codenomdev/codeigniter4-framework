<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\Setting;

use Codenom\Framework\Data\ObjectManager\ObjectManager;

class SettingManager
{
    protected $objectManager;
    protected $countryManager;

    public function __construct()
    {
        $this->objectManager = new ObjectManager('setting');
    }

    public function getGroupSettingByScope()
    {
        //SELECT id, code, value, GROUP_CONCAT(code SEPARATOR ' ') FROM setting GROUP BY scope
        return $this->objectManager
            ->select('scope')
            // ->select('scope')
            ->groupBy('scope')
            // ->where(['scope' => 'general'])
            ->load()
            ->getResult();
    }
    /**
     * Prepare load Setting
     * 
     * @return mixed
     */
    public function getSetting()
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
        if (!$found = cache('settingCollection')) {
            $found = $this->objectManager->load()->getResult();
            cache()->save('settingCollection', $found, 3600);
        }
        return $found;
    }

    /**
     * Get Setting by Scope
     * 
     * @param string $scope
     * @return obj
     */
    public function getByScope(string $scope)
    {
        if (!$found = cache($scope . '_scopeSettingData')) {
            $found = $this->objectManager->where(['scope' => $scope])->load()->getResult();
            cache()->save($scope . '_scopeSettingData', $found, 3600);
        }
        return $found;
    }

    /**
     * Get Setting by ID
     * 
     * @param int $id
     * @return obj
     */
    public function getById(int $id)
    {
        if (!$found = cache($id . '_settingData')) {
            $found = $this->objectManager->where(['id' => $id])->load()->getRow();
            cache()->save($id . '_settingData', $found, 3600);
        }
        return $found;
    }

    /**
     * Get setting by ID Code
     * 
     * @param int $id
     * @return obj
     */
    public function getByCode(string $code)
    {
        if (!$found = cache($code . '_settingCodeCollection')) {
            $found = $this->objectManager->where(['code' => $code])->load()->getResult();
            cache()->save($code . '_settingCodeCollection', $found, 3600);
        }

        return $found;
    }

    /**
     * Get Setting by Key
     * 
     * @param string $key
     * @return obj
     */
    public function getByKey(string $key)
    {
        if (!$found = cache($key . '_settingKeyCollection')) {
            $found = $this->objectManager->where(['key' => $key])->load()->getRow();
            cache()->save($key . '_settingKeyCollection', $found, 3600);
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
     * Join table
     * 
     * @param string $table of table name
     * @param string $cond condition
     * @param string $type
     * 
     * @return mixed
     */
    public function join($table, $cond, $type = '')
    {
        $this->objectManager->join($table, $cond, $type);
        return $this;
    }

    /**
     * Setting select table
     * 
     * @var \Codenom\Framework\Data\ObjectManager\ObjectManager
     * @return mixed
     */
    private function selectTable()
    {
        $this->objectManager->select('id as setting_id, code as setting_code, key as setting_key, value as setting_value, scope as setting_scope');
        return $this;
    }
}
