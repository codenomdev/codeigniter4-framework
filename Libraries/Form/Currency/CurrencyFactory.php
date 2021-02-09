<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Form\Currency;

use Codenom\Framework\Data\Currency\CurrencyManager;

class CurrencyFactory implements CurrencyInterface
{
    protected $currencyManager;

    public function __construct()
    {
        $this->currencyManager = new CurrencyManager();
    }

    /**
     * Get country id for rules form in_list
     * 
     * @return string
     */
    public function getCurrencyInList(): string
    {
        $countryManager = $this->currencyManager->select('id as currency_id')->getCollection();
        $data = [];
        foreach ($countryManager as $key => $value) {
            $data[$key] = $value->currency_id;
        }

        $list = implode($data, ',');

        return $list;
    }
}
