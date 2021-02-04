<?php

namespace Codenom\Framework\Libraries\Auth;

class Authentication implements AuthenticationInterface
{
    protected $config;
    protected $auth;
    protected $session;

    public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('AuthConfig');
        $this->auth = service('authentication');
    }

    /**
     * Check any session user?
     * 
     * @return mixed
     */
    public function checkIfLoggedIn(): bool
    {
        // No need to show a login form if the user
        // is already logged in.
        if ($this->auth->check()) {
            return true;
        }
        return false;
    }
}
