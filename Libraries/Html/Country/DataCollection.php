<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Html\Country;

use Codenom\Framework\Libraries\Collection\CountryCollection;

class DataCollection
{
    public function __construct()
    {
        helper('admin');
    }
    /**
     * Country Dropdown html
     * 
     * @param string $defaultValue
     * @return string
     */
    public function countryConvertToHtml($defaultValue = '')
    {
        $country = new CountryCollection();
        $result = [];
        $html = '';
        $result = ['' => '-- Please Select --'];
        $html .= \add_field_dropdown('country_id', $country->countryWithIndexId(), set_value('country_id', $defaultValue), ['label' => lang('Country.form.label.nameCountry'), 'id' => 'NameCountry', 'class' => 'js-select2 form-control']);
        return $html;
    }
}
