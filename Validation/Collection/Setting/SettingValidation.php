<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Validation\Collection\Setting;

use Codenom\Framework\Config\ValidationConfig;

class SettingValidation extends ValidationConfig
{

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
