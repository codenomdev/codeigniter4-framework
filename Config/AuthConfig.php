<?php

namespace Codenom\Framework\Config;

use Myth\Auth\Config\Auth as ConfigAuth;
use Codenom\Framework\Config\Auth\AuthManager;

class AuthConfig extends ConfigAuth
{
    //--------------------------------------------------------------------
    // Authentication
    //--------------------------------------------------------------------
    // Fields that are available to be used as credentials for login.
    public $validFields = [
        'username'
    ];

    //--------------------------------------------------------------------
    // Allow User Registration
    //--------------------------------------------------------------------
    // When enabled (default) any unregistered user may apply for a new
    // account. If you disable registration you may need to ensure your
    // controllers and views know not to offer registration.
    //
    public $allowRegistration = false;
}
