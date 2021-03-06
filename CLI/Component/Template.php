<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\CLI\Component;

use CodeIgniter\CLI\CLI;

class Template
{
    /**
     * Default namespace
     */
    const DEFAULT_NAMESPACE = 'Codenom\Framework\Config';

    /**
     * Replace namespace
     */
    const REPLACE_NAMESPACE = 'Config';

    /**
     * Locate file Autoload
     */
    const LOCATE_AUTOLOAD = __DIR__ . '/../../Config/Autoload.php';

    /**
     * Waiting compile
     */
    const WAITING_SECOND = '1';

    /**
     * Title Compile
     */
    const COMPILE_TITLE = 'Please wait, Compiled system is a running:';

    /**
     * Check permission title
     */
    const PERMISSION_TITLE = 'Check folder permission:';

    /**
     * Check permission is successfully
     */
    const PERMISSION_SUCCESS = 'Check folder permission is successfully.';

    /**
     * Check permission is fail
     */
    const PERMISSION_FAIL = 'Ops, can\'t create, read, write folder. Please, contact http://codenom.com/contact';

    /**
     * Remove file Autoload.php on path writable is successfully
     */
    const REMOVE_AUTOLOAD_SUCCESS = 're-built Autoload is successfully.';

    /**
     * Remove file Autoload.php on path writable is unsuccessfully
     */
    const REMOVE_AUTOLOAD_UNSUCCESS = 're-built Autoload is fail. Please, contact http://codenom.com/contact';

    /**
     * Generate Autoload successfully
     */
    const GENERATE_AUTOLOAD_SUCCESS = 'Generate Autoload is successfully.';

    /**
     * Generate Autoload successfully
     */
    const GENERATE_AUTOLOAD_UNSUCCESS = 'Generate Autoload is successfully.';

    /**
     * Open Autoload in file php
     * 
     * @return string
     */
    private function openAutoloadGenerate()
    {
        $content = '';
        $content = "<?php\n" . \PHP_EOL;
        $content .= "return [" . \PHP_EOL;

        return $content;
    }

    /**
     * DOM Content with registration module
     * 
     * @return string
     */
    public function contentAutoloadGenerate(array $data = [])
    {
        $schemaString = '';
        $schemaString = $this->openAutoloadGenerate();
        foreach ($data as $key => $value) {
            $schemaString .= "    '{$key}' => " . Generate::ACTIVE_MODULE . ',' . \PHP_EOL;
            $this->waitingCompile();
            CLI::write("'{$key}' => Active", 'light_gray');
        }
        $schemaString .= $this->afterOpenAutoloadGenerate();

        return $schemaString;
    }

    /**
     * End Autoload in file php
     * 
     * @return string
     */
    private function afterOpenAutoloadGenerate()
    {
        $content = '';
        $content = '];' . \PHP_EOL;

        return $content;
    }

    /**
     * Waiting Compile.
     * 
     * @param int $second by default 1 second/'s
     * @return CLI::wait
     */
    public function waitingCompile(int $second = SELF::WAITING_SECOND)
    {
        return CLI::wait($second);
    }

    /**
     * Compile Title
     * 
     * @var Template::COMPILE_TITLE
     * @return CLI::write
     */
    public function compileTitle()
    {
        return CLI::write(SELF::COMPILE_TITLE) . CLI::newLine();
    }

    /**
     * Check folder permission title
     * 
     * @var Template::PERMISSION_TITLE
     * @return CLI::write       color: dark_gray
     */
    public function checkFolderPermissionTitle()
    {
        return CLI::write(SELF::PERMISSION_TITLE, 'dark_gray');
    }

    /**
     * Check folder permission if successfully
     * 
     * @var Template::PERMISSION_SUCCESS
     * @return CLI::write       color: green
     */
    public function successfullyCheckPermissionFolder()
    {
        return CLI::write(SELF::PERMISSION_SUCCESS, 'green');
    }

    /**
     * Check folder permission if unsuccessfully
     * 
     * @var Template::PERMISSION_UNSUCCESS
     * @return CLI::error
     */
    public function unsuccessfullyCheckPermissionFolder()
    {
        return CLI::error(SELF::PERMISSION_FAIL);
    }

    /**
     * Remove Autoload in writable if successfully.
     * 
     * @var Template::REMOVE_AUTOLOAD_SUCCESS
     * @return CLI::write       color: green
     */
    public function successfullyRemoveAutoload()
    {
        return CLI::write(SELF::REMOVE_AUTOLOAD_SUCCESS, 'green');
    }

    /**
     * Remove Autoload in writable if unsuccessfully.
     * 
     * @var Template::REMOVE_AUTOLOAD_UNSUCCESS
     * @return CLI::error
     */
    public function unsuccessfullyRemoveAutoload()
    {
        return CLI::error(SELF::REMOVE_AUTOLOAD_UNSUCCESS);
    }

    /**
     * Generate Autoload in writable if successfully.
     * 
     * @var Template::GENERATE_AUTOLOAD_SUCCESS
     * @return CLI::write       color: green
     */
    public function successfullyGenerateAutoload()
    {
        return CLI::write(SELF::GENERATE_AUTOLOAD_SUCCESS, 'green');
    }

    /**
     * Generate Autoload in writable if unsuccessfully.
     * 
     * @var Template::GENERATE_AUTOLOAD_UNSUCCESS
     * @return CLI::error
     */
    public function unsuccessfullyGenerateAutoload()
    {
        return CLI::error(SELF::GENERATE_AUTOLOAD_UNSUCCESS);
    }

    /**
     * New line in command CLI
     * 
     * @return CLI::newLine()
     */
    public function newLine()
    {
        return CLI::newLine();
    }
}
