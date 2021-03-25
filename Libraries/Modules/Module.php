<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Modules;

class Module extends AbstractModule
{
    public function load($module)
    {
        $return = parent::load($module);

        return $return;
    }

    public function getConfiguration()
    {
        if ($this->load('codenom')) {
            return $this->call('config');
        }
    }
}
