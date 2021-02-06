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

    /**
     * @var Codenom\Framework\Data\ObjectManager\ObjectManager
     */
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
        if (!$found = cache('_countryCollection')) {
            $found = $this->objectManager->ordering('name', ' ASC')->load()->getResult();
            cache()->save('_countryCollection', $found, 3600);
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
        if (!$found = cache($name . '_countryData')) {
            $found = $this->objectManager->where(['name' => $name])->load()->getRow();
        }
        return $found;
    }

    /**
     * Get country by id country
     * 
     * @param int $country_id
     * @return obj
     */
    public function getById(int $country_id)
    {
        if (!$found = cache($country_id . '_countryData')) {
            $found = $this->objectManager->where(['id' => $country_id])->load()->getRow();
            cache()->save($country_id . '_countryData', $found, 3600);
        }
        return $found;
    }

    /**
     * Spesific selecting field/'s table
     * 
     * @param string|array $select
     *                     Example: 'id, name, etc..' or ['id', 'name'].
     *                     Support aliase of name fields table.
     * @return mixed 
     */
    public function select($select)
    {
        $this->objectManager->select($select);
        return $this;
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
