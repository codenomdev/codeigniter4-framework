<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Result;

use Codenom\Framework\Views\Templates\Config\Config;

class PageFactory
{
    protected $getConfig;

    public function __construct()
    {
        $this->getConfig = new Config();
    }

    public function getConfig()
    {
        return $this->getConfig;
    }
}
