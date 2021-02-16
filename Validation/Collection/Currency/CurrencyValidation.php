<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Validation\Collection\Currency;

use Codenom\Framework\Config\ValidationConfig;

class CurrencyValidation extends ValidationConfig
{

    //--------------------------------------------------------------------
    // Set a Add Currency Rules
    //--------------------------------------------------------------------
    public $addCurrency = [
        'title' => [
            'label' => 'Currency.form.label.titleCurrency',
            'rules' => 'required|min_length[3]|max_length[32]',
        ],
        'code' => [
            'label' => 'Currency.form.label.codeCurrency',
            'rules' => 'required|iso_code_3',
        ],
        // 'symbol_left' => [
        //     'label' => 'Currency.form.label.symbolLeftCurrency',
        // ],
        // 'symbol_right' => [
        //     'label' => 'Currency.form.label.symbolRightCurrency',
        // ],
        // 'decimal_places' => [
        //     'label' => 'Currency.form.label.decimalPlaces',
        // ],
        // 'value' => [
        //     'label' => 'Currency.form.label.value',
        // ],
        'status' => [
            'label' => 'Currency.form.label.status',
            'rules' => 'required|in_list[1,0]'
        ]
    ];

    //--------------------------------------------------------------------
    // Set a Edit Currency Rules
    //--------------------------------------------------------------------
    public $editCurrency = [
        'id' => [
            'label' => 'Currency.form.label.idCurrency',
            'rules' => 'required|is_natural_no_zero',
        ],
        'title' => [
            'label' => 'Currency.form.label.titleCurrency',
            'rules' => 'required|min_length[3]|max_length[32]',
        ],
        'code' => [
            'label' => 'Currency.form.label.codeCurrency',
            'rules' => 'required|iso_code_3',
        ],
        // 'symbol_left' => [
        //     'label' => 'Currency.form.label.symbolLeftCurrency',
        // ],
        // 'symbol_right' => [
        //     'label' => 'Currency.form.label.symbolRightCurrency',
        // ],
        // 'decimal_places' => [
        //     'label' => 'Currency.form.label.decimalPlaces',
        // ],
        // 'value' => [
        //     'label' => 'Currency.form.label.value',
        // ],
        'status' => [
            'label' => 'Currency.form.label.status',
            'rules' => 'required|in_list[1,0]'
        ]
    ];
}
