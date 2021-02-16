<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Validation\Collection\Zone;

use Codenom\Framework\Config\ValidationConfig;

class ZoneValidation extends ValidationConfig
{
    //--------------------------------------------------------------------
    // Set a Add Zone Rules
    //--------------------------------------------------------------------
    public $addZone = [
        'country_id' => [
            'label' => 'Country.form.label.nameCountry',
            'rules' => 'required|country_list',
        ],
        'name' => [
            'label' => 'Zone.form.label.nameZone',
            'rules' => 'required|min_length[3]|max_length[50]',
        ],
        'code' => [
            'label' => 'Zone.form.label.codeZone',
            'rules' => 'required|iso_code_3',
        ],
        'status' => [
            'rules' => 'required|in_list[1,0]'
        ],
    ];

    //--------------------------------------------------------------------
    // Set a Edit Zone Rules
    //--------------------------------------------------------------------
    public $editZone = [
        'zone_id' => [
            'rules' => 'required|is_natural_no_zero',
        ],
        'country_id' => [
            'label' => 'Country.form.label.nameCountry',
            'rules' => 'required|country_list',
        ],
        'name' => [
            'label' => 'Zone.form.label.nameZone',
            'rules' => 'required|min_length[3]|max_length[50]',
        ],
        'code' => [
            'label' => 'Zone.form.label.codeZone',
            'rules' => 'required|iso_code_3',
        ],
        'status' => [
            'rules' => 'required|in_list[1,0]'
        ],
    ];
}
