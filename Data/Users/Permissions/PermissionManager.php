<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\Users\Permissions;

use Codenom\Framework\Data\ObjectManager\ObjectManager;

class PermissionManager
{
    /**
     * @var \Codenom\Framework\ObjectManager\ObjectManager
     */
    protected $objectManager;

    /**
     * Constructor class
     */
    public function __construct()
    {
        $this->objectManager = new ObjectManager('auth_permissions', false);
    }

    /**
     * Prepare Auth Permission\'s
     * 
     * @return obj
     */
    public function getPermission()
    {
        $this->selectTable();
        return $this;
    }

    /**
     * Get Collection Permission
     * 
     * @return obj
     */
    public function getCollection()
    {
        if (!$found = cache('userPermissionCollection')) {
            $found = $this->objectManager->load()->getResult();
            cache()->save('userPermissionCollection', $found, 3600);
        }

        return $found;
    }

    /**
     * Get Permission by ID
     * 
     * @param int $id
     */
    public function getById(int $id)
    {
        if (!$found = cache($id . '_userPermissionById')) {
            $found = $this->objectManager->where(['id' => $id])->load()->getRow();
            cache()->save($id . '_userPermissionById', $found, 3600);
        }

        return $found;
    }

    /**
     * auth_permission select
     * 
     * @param string|array $fields
     * @return mixed
     */
    public function select($fields)
    {
        $this->objectManager->select($fields);
        return $this;
    }

    /**
     * auth_permissions select table
     * 
     * @return mixed
     */
    private function selectTable()
    {
        $this->objectManager->select('id as permission_id, name as permission_name, description as permission_description');
        return $this;
    }
}
