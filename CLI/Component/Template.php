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
    const REPLACE_NAMESPACE = 'Config;';

    /**
     * Locate file Autoload
     */
    const LOCATE_AUTOLOAD = __DIR__ . '/../../Config/Autoload.php';

    /**
     * Publish Autoload successfully
     */
    const PUBLISH_AUTOLOAD_SUCCESS = 'Publish Autoload is successfully';

    /**
     * Publish Autoload unsuccessfully
     */
    const PUBLISH_AUTOLOAD_UNSUCCESS = 'Publish Autoload is unsuccessfully';

    /**
     * Waiting compile
     */
    const WAITING_SECOND = '1';

    /**
     * Title Compile
     */
    const COMPILE_TITLE = 'Please wait, Compiled system is a running:';

    /**
     * Title Publish Autoload Config
     */
    const PUBLISH_AUTOLOAD_TITLE = 'Please wait, publish Autoload is a running:';

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
     * Update module title progress
     */
    const PROGRESS_UPDATE_MODULE = 'Updating module:';

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
        $this->newLine();
        CLI::write(SELF::PROGRESS_UPDATE_MODULE, 'dark_gray');
        $this->newLine();
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
     * DOM publish Autoload Config
     * 
     * @param string $autoloadConfig
     * @return string
     */
    public function domPublishAutoload(string $autoloadConfig = '')
    {
        $schema = $this->domSchemaAutoloadPsr4($autoloadConfig);

        return (string) $schema;
    }

    /**
     * Publish Autoload Config
     * 
     * @param string $autoloadConfig
     * @param $content
     * 
     * @return string
     */
    public function publishAutoload(string $autoloadConfig = '', $content)
    {
        $content = str_replace('namespace Codenom\Framework\Config', 'namespace ' . SELF::REPLACE_NAMESPACE, $content);
        $content = str_replace('public $psr4 = [];', $this->domPublishAutoload($autoloadConfig), $content);

        return $content;
    }

    /**
     * DOM schema Autoload PSR-4
     * 
     * @param string $psr4Dom
     * @return string
     */
    private function domSchemaAutoloadPsr4(string $psr4Dom = '')
    {
        $schema = 'public $psr4 = [' . \PHP_EOL;
        $schema .= "		APP_NAMESPACE => APPPATH," . \PHP_EOL;
        $schema .= "		'Config' => APPPATH . 'Config'," . \PHP_EOL;
        $schema .= $psr4Dom;
        $schema .= "	];" . \PHP_EOL;

        return $schema;
    }

    /**
     * Publish Autoload Config is successfully
     * 
     * @var Template::PUBLISH_AUTOLOAD_SUCCESS
     * @var CLI::write
     */
    public function publishAutoloadSuccessfully()
    {
        return CLI::write(SELF::PUBLISH_AUTOLOAD_SUCCESS, 'green');
    }

    /**
     * Publish Autoload Config is unsuccessfully
     * 
     * @var Template::PUBLISH_AUTOLOAD_UNSUCCESS
     * @var CLI::write
     */
    public function publishAutoloadUnsuccessfully()
    {
        return CLI::error(SELF::PUBLISH_AUTOLOAD_UNSUCCESS);
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
     * Publish Autoload Config title
     * 
     * @var Template::PUBLISH_AUTOLOAD_TITLE
     * @var CLI::write
     */
    public function publishAutoloadConfigTitle()
    {
        return CLI::write(SELF::PUBLISH_AUTOLOAD_TITLE);
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
