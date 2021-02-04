<?php

namespace Codenom\Framework\Config;

use Myth\Auth\Config\Auth as ConfigAuth;

class AuthConfig extends ConfigAuth
{
    //--------------------------------------------------------------------
    // Authentication
    //--------------------------------------------------------------------
    // Fields that are available to be used as credentials for login.
    public $validFields = [
        'username'
    ];
}
