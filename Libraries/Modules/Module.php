<?php

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
