<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config\Currency;

use CodeIgniter\Config\BaseConfig;
use Codenom\Framework\Libraries\Form\Currency\CurrencyFactory;

/**
 * Currency Rules
 * 
 * @author Ilham Falachul Adha
 * @link https://codenom.com
 * @version 1.0
 * @package Codenom/Framework
 */
class CurrencyRules
{
    public function currency_list(string $value = null): bool
    {
        $list = new CurrencyFactory();
        $list = array_map('trim', explode(',', $list->getCurrencyInList()));
        return in_array($value, $list, true);
    }
}
