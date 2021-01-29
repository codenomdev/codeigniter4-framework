<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Html\Country;

use Codenom\Framework\Data\Country\CountryManager;

class DataCollection
{
    /**
     * Country Dropdown html
     * 
     * @param string $defaultValue
     * @return string
     */
    public function countryConvertToHtml($defaultValue = '')
    {
        $country = new CountryManager();
        $result = [];
        $html = '';

        foreach ($country->getLocale()->getCollection() as $key => $value) {
            $result[$value->country_id] = $value->country_name;
        }

        $html .= \add_field_dropdown('country_id', $result, set_value('country_id', $defaultValue), ['label' => 'Name Country', 'id' => 'NameCountry', 'class' => 'js-select2 form-control']);
        return $html;
    }
}
