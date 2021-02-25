<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models\Users\Permission;

use CodeIgniter\Model;
use Codenom\Framework\Entities\Users\Permission\PermissionEntity;

class PermissionModel extends Model
{
    protected $table = 'auth_permissions';
    protected $primaryKey = 'id';

    protected $returnType = PermissionEntity::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'description'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[20]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}
