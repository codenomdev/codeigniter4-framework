<?php

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
