<?php

namespace Codenom\Framework\Libraries\Auth;

interface AuthenticationInterface
{
    /**
     * Check any session user?
     * 
     * @return mixed
     */
    public function checkIfLoggedIn(): bool;
}
