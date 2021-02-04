<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

// override core en language system validation or define your own en language validation message
return [
    'iso_code_2' => 'The ISO Code 2 field not valid.',
    'iso_code_3' => 'The ISO Code 3 field not valid.',
    'country_list' => 'ID Country not valid',
    'username' => [
        'required' => 'Please enter a username',
        'minlength_custom' => 'Your username must consist of at least 3 characters',
    ],
    'password' => [
        'required' => 'Please enter a password',
        'minlength_custom' => 'Your password must be at least 5 characters long',
    ],
];
