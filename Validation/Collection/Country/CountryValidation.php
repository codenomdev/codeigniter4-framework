<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Validation\Collection\Country;

use Codenom\Framework\Config\ValidationConfig;

class CountryValidation extends ValidationConfig
{

    //--------------------------------------------------------------------
    // Set a Add Country Rules
    //--------------------------------------------------------------------
    public $addCountry = [
        'name' => [
            'label' => 'Country.form.label.nameCountry',
            'rules' => 'required|min_length[3]|max_length[25]',
        ],
        'iso_code_2' => [
            'label' => 'Country.form.label.isoCode2',
            'rules' => 'required|iso_code_2',
        ],
        'iso_code_3' => [
            'label' => 'Country.form.label.isoCode3',
            'rules' => 'required|iso_code_3',
        ],
        'status' => [
            'label' => 'Status',
            'rules' => 'required|in_list[0,1]',
        ],
    ];

    //--------------------------------------------------------------------
    // Set a Edit Country Rules
    //--------------------------------------------------------------------
    public $editCountry = [
        'id' => [
            'rules' => 'required|is_natural_no_zero',
        ],
        'name' => [
            'label' => 'Country.form.label.nameCountry',
            'rules' => 'required|min_length[3]|max_length[25]',
        ],
        'iso_code_2' => [
            'label' => 'Country.form.label.isoCode2',
            'rules' => 'required|iso_code_2',
        ],
        'iso_code_3' => [
            'label' => 'Country.form.label.isoCode3',
            'rules' => 'required|iso_code_3',
        ],
        'status' => [
            'label' => 'Status',
            'rules' => 'required|in_list[0,1]',
        ],
    ];
}
