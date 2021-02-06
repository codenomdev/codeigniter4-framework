<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Html\Currency;

use Codenom\Framework\Data\Currency\CurrencyManager;

class DataCollection
{

    /**
     * @var Codenom\Framework\Data\Currency\CurrencyManager
     */
    protected $currencyManager;

    public function __construct()
    {
        $this->currencyManager = new CurrencyManager();
    }

    public function currencyCollection()
    {
        $attribute = [];
        $currency = $this->currencyManager->getCurrency()->getCollection();

        foreach ($currency as $key => $value) {
            $attribute[$value->currency_id] = $value;
        }

        return $attribute;
    }
}
