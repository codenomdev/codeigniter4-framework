<?php

namespace Codenom\Framework\Data\Country;

class CountryManager extends \Codenom\Framework\Models\Country\CountryModel
{
    public function countryCollection($where = '')
    {
        return $this->select()->get()->getResult();
    }

    /**
     * Select Column Country
     */
    public function select()
    {
        $this->db->table('country')->select('id', 'name as country_name', 'iso_code_2', 'iso_code_3', 'status');
        return $this;
    }
}
