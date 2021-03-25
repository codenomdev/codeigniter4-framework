<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\CLI\Component;

use Codenom\Framework\Code\Generator\Io;
use Codenom\Framework\Components\ComponentRegistrar;
use Codenom\Framework\Code\NameBuilders;
use Codenom\Framework\Components\ComponentFile;
use Codenom\Framework\Drive\File as Files;
use Codenom\Framework\Filesystem\DirectoryList;

class Generate
{
    /**
     * Default path generated/app
     */
    const DEFAULT_PATH = \WRITEPATH . 'generated\\app';

    /**
     * Default module is active
     */
    const ACTIVE_MODULE = '1';

    /**
     * Get Autoload Config
     */
    const AUTOLOAD_CONFIG_FILE = __DIR__ . '/../../Config/Autoload.php';

    /**
     * Publish directory Autoload Config
     */
    const PUBLISH_AUTOLOAD_CONFIG = \APPPATH . 'Config\\Autoload.php';

    /**
     * Default CHMOD
     * 
     * For security, don't modify CHMOD
     */
    const CHMOD = '0777';

    /**
     * Default path locate module
     * 
     * @var string
     */
    const DEFAULT_CODE = 'Code';

    /**
     * @var Codenom\Framework\Code\Generator\Io
     */
    protected $generator;

    /**
     * @var Codenom\Framework\Code\NameBuilders
     */
    protected $nameBuilder;

    /**
     * For get namespace
     * 
     * @return mixed
     */
    private $nameSpace = null;

    /**
     * For Component
     * 
     * @return array
     */
    protected $component = [];

    /**
     * @var Codenom\Framework\Drive\File
     */
    protected $drive;

    /**
     * @var Codenom\Framework\CLI\Component\File
     */
    protected $filesystem;

    /**
     * Constructor Class
     * 
     * @var Codenom\Framework\Code\Generator\Io
     * @var Codenom\Framework\CLI\Component\File
     * @var Codenom\Framework\Drive\File
     * @var Codenom\Framework\Code\NameBuilders
     */
    public function __construct()
    {
        $this->generator = new Io(SELF::DEFAULT_PATH);
        $this->filesystem = new File();
        $this->drive = new Files();
        $this->nameBuilder = new NameBuilders();
    }

    /**
     * Check path \WRITEPATH . 'generated/app
     * 
     * If available directory, then skip for create directory.
     * If not avaiable directory, create directory
     * 
     * @return bool
     */
    public function checkPermissionWritableDirectory()
    {
        $content = [];
        foreach ($this->filesystem->getInstallationWritableDirectories() as $key => $value) {
            if (($this->drive->isDirectory($value) === true || $this->drive->createDirectory($value, SELF::CHMOD)) && ($this->drive->isWritable($value) === true || $this->drive->changePermissions($value, SELF::CHMOD))) {
                $content[$key] = $value;
            }
        }
        return $content;
    }

    /**
     * Remove generate file Autoload.php
     * 
     * @return bool
     */
    public function removeGenerateAutoload()
    {
        $getFile = SELF::DEFAULT_PATH . \DIRECTORY_SEPARATOR . DirectoryList::FILE_AUTOLOAD;
        if ($this->drive->isFile($getFile) === true && $this->generator->fileExists($getFile) === true) {
            return $this->drive->deleteFile($getFile);
        }

        return false;
    }

    /**
     * Get namespace for PSR-4
     *     Example: ['Module\Dashboard' => pathOfModuleByRegistration]
     * 
     * @return array
     */
    public function getPathNameSpacePsr()
    {
        $nameSpaceArray = [];
        foreach ($this->searchFileRegistration() as $key => $value) {
            $nameSpaceArray[$key] = $this->nameBuilders($this->builderGetNameModule($key, $value));
        }
        return $nameSpaceArray;
    }

    /**
     * Generate Autoload File
     * 
     * @param string $path
     * @param string $content
     * @param string|null $mode
     * @return int The number of bytes that were written.
     * @throws FileSystemException
     */
    public function fileCreate(string $content, string $mode = null)
    {
        $path = SELF::DEFAULT_PATH . \DIRECTORY_SEPARATOR . 'Autoload.php';
        return $this->drive->filePutContents($path, $content, $mode);
    }

    /**
     * Get name Module
     * by default module registered is active
     * 
     * @return array
     */
    public function getNameModule()
    {
        $nameSpaceArray = [];
        foreach ($this->searchFileRegistration() as $key => $value) {
            $nameSpaceArray[$key] = SELF::ACTIVE_MODULE;
        }
        return $nameSpaceArray;
    }

    /**
     * Builder for get name of module
     *         Example: Module_Dashboard
     * 
     * @param string $componentName
     * @param string $fullPath
     * @var Codenom\Framework\Components\ComponentFile
     * 
     * @return string
     */
    public function builderGetNameModule(string $componentName = '', string $fullPath = '')
    {
        $this->component = (new ComponentFile(
            ComponentRegistrar::MODULE,
            $componentName,
            $fullPath
        ))->getComponentName();

        return $this->component;
    }

    /**
     * Convert namespace
     *        Example: Module_Dashboard
     *        To: Module\Dashboard
     * 
     * @param string $namespace
     * @return string
     */
    public function nameBuilders(string $nameSpace = '')
    {
        $this->nameSpace = $this->nameBuilder->buildClassName([$nameSpace]);
        return $this->nameSpace;
    }

    /**
     * Search module registration
     * 
     * @return mixed
     */
    public function searchFileRegistration()
    {
        foreach (glob(APPPATH . 'Code/*/*', GLOB_ONLYDIR) as $item) {
            $nameFile = $item . '/registration.php';
            if ($this->generator->fileExists($nameFile)) {
                $this->generator->includeFile($nameFile);
            }
        }
        $component = (new ComponentRegistrar)->getPaths(ComponentRegistrar::MODULE);
        return $component;
    }

    /**
     * Prepare publish generate Autoload.php
     * 
     * @var public function nameBuilder
     * @var SELF::DEFAULT_CODE path
     * @return string
     */
    public function preparePublishGenerateAutoload()
    {
        $content = '';
        if (is_array($this->includeGenerateAutoloadOnWritable())) {
            foreach ($this->includeGenerateAutoloadOnWritable() as $key => $value) {
                if (array_key_exists($key, $this->includeGenerateAutoloadOnWritable())) {
                    if ($value === 1) {
                        $content .= "		'" . $this->nameBuilders($key) . "' => \APPPATH . '" . SELF::DEFAULT_CODE . \DIRECTORY_SEPARATOR . $this->nameBuilders($key) . "'," . \PHP_EOL;
                    }
                }
            }
        }
        return (string) $content;
    }

    /**
     * Get Autoload Config
     */
    public function getAutoloadConfig()
    {
        return $this->drive->fileGetContents(SELF::AUTOLOAD_CONFIG_FILE);
    }

    /**
     * File put content Autoload Config
     */
    public function moveAutoloadConfig($content)
    {
        return $this->drive->filePutContents(SELF::PUBLISH_AUTOLOAD_CONFIG, $content);
    }

    /**
     * Include generated autoload on path writable
     * 
     * @var Generator
     * @return mixed
     */
    private function includeGenerateAutoloadOnWritable()
    {
        return $this->generator->includeFile(SELF::DEFAULT_PATH . \DIRECTORY_SEPARATOR . DirectoryList::FILE_AUTOLOAD);
    }
}
