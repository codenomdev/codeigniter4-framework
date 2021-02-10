<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config;

class ValidationConfig
{
    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var array
     */
    public $ruleSets = [
        \CodeIgniter\Validation\Rules::class,
        \CodeIgniter\Validation\FormatRules::class,
        \CodeIgniter\Validation\FileRules::class,
        \CodeIgniter\Validation\CreditCardRules::class,
        \Codenom\Framework\Config\Country\CountryRules::class,
        \Codenom\Framework\Config\Currency\CurrencyRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Set a General Rules
    //--------------------------------------------------------------------
    public $general = [
        'currency_default.value' => [
            'rules' => 'required|currency_list',
        ],
        'country_default.value' => [
            'rules' => 'required|country_list',
        ],
    ];

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

    //--------------------------------------------------------------------
    // Set a Authentication Rules
    //--------------------------------------------------------------------
    public $authentication = [
        'allow_registration.value' => [
            'label' => 'Rules.authentication.label.allow_registration',
            'rules' => 'required|in_list[1,0]',
        ],
        'allow_remembering.value' => [
            'label' => 'Rules.authentication.label.allow_remembering',
            'rules' => 'required|in_list[1,0]',
        ],
        'require_activation.value' => [
            'label' => 'Rules.authentication.label.allow_activation',
            'rules' => 'required|in_list[1,0]',
        ],
    ];

    //--------------------------------------------------------------------
    // Set a SMTP Rules
    //--------------------------------------------------------------------
    public $smtp = [
        'smtp_hostname.value' => [
            'label' => 'Rules.smtp.label.smtp_hostname',
            'rules' => 'required'
        ],
        'smtp_username.value' => [
            'label' => 'Rules.smtp.label.smtp_username',
            'rules' => 'required_with[smtp_hostname]',
        ],
        'smtp_password.value' => [
            'label' => 'Rules.smtp.label.smtp_password',
            'rules' => 'required_with[smtp_hostname]',
        ],
        'smtp_port.value' => [
            'label' => 'Rules.smtp.label.smtp_port',
            'rules' => 'required|in_list[25,465,587,2525]',
        ],
        'smtp_timeout.value' => [
            'label' => 'Rules.smtp.label.smtp_timeout',
            'rules' => 'required_with[smtp_hostname]'
        ]
    ];
}
