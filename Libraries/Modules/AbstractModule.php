<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Modules;

abstract class AbstractModule
{
    protected $loadedModule = '';

    const FUNCTIONDOESNTEXIST = "!Function not found in module!";
    const REGISTRATION_MODULE_NAME = 'registration';

    protected function setLoadedModule($module)
    {
        $this->loadedModule = $module;
    }

    public function getLoadedModule()
    {
        return SELF::REGISTRATION_MODULE_NAME;
    }

    public function getBaseModulesDir(): string
    {
        return APPPATH . 'Modules';
    }

    public function getModulePath($module): string
    {
        $module = \ucfirst($module);
        return $this->getBaseModulesDir() . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . "registration.php";
    }

    public function load($module)
    {
        $modPath = $this->getModulePath($module);

        if (file_exists($modPath)) {
            include_once($modPath);
            $this->setLoadedModule($module);
            return true;
        }

        return false;
    }

    public function call($function)
    {
        if ($this->functionExists($function)) {
            return call_user_func($this->getLoadedModule() . "_" . $function);
        }

        return SELF::FUNCTIONDOESNTEXIST;
    }

    public function functionExists($name)
    {
        return function_exists($this->getLoadedModule() . "_" . $name);
    }
}
