<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config;

use CodeIgniter\Config\BaseService;
use Codenom\Framework\Config\ValidationConfig;
use CodeIgniter\Validation\Validation;

class Services extends BaseService
{
    /**
     * The Validation class provides tools for validating input data.
     *
     * @param ValidationConfig|null $config
     * @param boolean               $getShared
     *
     * @return Validation
     */
    public static function validation($config = null, bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('validation', $config);
        }

        $config = $config ?? config('ValidationConfig');

        return new Validation($config, \Config\Services::renderer());
    }
}
