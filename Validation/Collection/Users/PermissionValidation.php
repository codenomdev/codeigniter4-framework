<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Validation\Collection\Users;

use Codenom\Framework\Config\ValidationConfig;

class PermissionValidation extends ValidationConfig
{
    //--------------------------------------------------------------------
    // Set a Permission Rules
    //--------------------------------------------------------------------
    public $addPermission = [
        'name' => [
            'label' => 'Name Permission',
            'rules' => 'required|min_length[3]|max_length[20]',
        ],
    ];
}
