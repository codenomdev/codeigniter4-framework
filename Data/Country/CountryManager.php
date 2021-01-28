<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\Country;

use Codenom\Framework\Data\ObjectManager\ObjectManager;

class CountryManager
{
    protected $objectManager;

    public function __construct()
    {
        $this->objectManager = new ObjectManager('country');
    }

    /**
     * Prepare load Country
     * 
     * @return mixed
     */
    public function getLocale()
    {
        $this->selectTable();
        return $this;
    }

    /**
     * Get Country Collection
     * 
     * @return obj
     */
    public function getCollection()
    {
        if (!$found = cache('_countryCollect')) {
            $found = $this->objectManager->load()->getResult();
            cache()->save('_countryCollection', $found, 300);
        }
        return $found;
    }

    /**
     * Get country by name country
     * 
     * @param string $name of country
     * @return obj
     */
    public function getByName(string $name)
    {
        return $this->objectManager->where(['name' => $name])->load()->getRow();
    }

    /**
     * Get country by id country
     * 
     * @param int $country_id
     * @return obj
     */
    public function getById(int $country_id)
    {
        return $this->objectManager->where(['id' => $country_id])->load()->getRow();
    }

    /**
     * Country select table
     * 
     * @var \Codenom\Framework\Data\ObjectManager\ObjectManager
     * @return mixed
     */
    private function selectTable()
    {
        $this->objectManager->select('id as country_id, name as country_name, iso_code_2, iso_code_3, status');
        return $this;
    }
}
