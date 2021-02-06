<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Collection;

use Codenom\Framework\Data\Currency\CurrencyManager;

class CurrencyCollection
{

    /**
     * @var Codenom\Framework\Data\Currency\CurrenyManager
     */
    protected $currencyCollection;

    public function __construct()
    {
        $this->currencyCollection = new CurrencyManager();
    }

    public function currencyWithIndexId()
    {
        $attribute = [];
        $currency = $this->currencyCollection->getCurrency()->where(['status' => 1])->getCollection();

        foreach ($currency as $key => $value) {
            $attribute[$value->currency_id] = $value->currency_title;
        }

        return $attribute;
    }
}
