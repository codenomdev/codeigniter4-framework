<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Collection;

use Codenom\Framework\Data\Country\CountryManager;

class CountryCollection
{

    /**
     * @var Codenom\Framework\Data\Country\CountryManager
     */
    protected $countryManager;

    public function __construct()
    {
        $this->countryManager = new CountryManager();
    }

    public function countryWithIndexId()
    {
        $result = [];
        foreach ($this->countryManager->getLocale()->getCollection() as $key => $value) {
            $result[$value->country_id] = $value->country_name;
        }

        return $result;
    }
}
