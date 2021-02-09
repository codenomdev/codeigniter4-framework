<?php

namespace Codenom\Framework\Config\Auth;

use Codenom\Framework\Data\Setting\SettingManager;

class AuthManager
{
    /**
     * @var \Codenom\Framework\Data\Setting\SettingManager
     */
    protected $settingManager;

    /**
     * @var bool $allowedRegistration = false;
     */
    protected $allowedRegistration = false;

    /**
     * Constructor Class
     */
    public function __construct()
    {
        $this->settingManager = new SettingManager();
    }

    /**
     * Authentication permission
     * 
     * Check, client can register via form?
     */
    public function allowRegistration()
    {
        if ($getAllowed = $this->settingManager->getSetting()->getByKey('allow_registration')) {

            return $this->allowedRegistration = $getAllowed->setting_value;
        }

        return $this->allowedRegistration;
    }

    /**
     * Authentication permision
     * 
     * Check, client can forgot password?
     */
    public function allowForgotPassword()
    {
    }
}
