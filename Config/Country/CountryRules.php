<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config\Country;

use CodeIgniter\Config\BaseConfig;

class CountryRules
{
    public function __construct()
    {
        $this->rules = new \CodeIgniter\Validation\Rules;
    }

    public function iso_code_2(string $val): bool
    {
        return (is_numeric(2) && 2 == mb_strlen($val));
    }

    public function iso_code_3(string $val): bool
    {
        return (is_numeric(3) && 3 == mb_strlen($val));
    }
}
