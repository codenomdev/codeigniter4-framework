<?php

namespace Codenom\Framework\Libraries;

// use \Oauth2\Storage\Pdo;

class Oauth
{
    var $server;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $dsn = \getenv('database.default.DSN');
        $username = \getenv('database.default.username');
        $password = \getenv('database.default.password');

        $storage = new \Codenom\Framework\Libraries\CustomOauthStorage(['dsn' => $dsn, 'username' => $username, 'password' => $password]);

        $this->server = new \OAuth2\Server($storage);
        $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage));
    }
}
