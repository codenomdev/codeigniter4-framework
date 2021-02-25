<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Code\Generator;

use Codenom\Framework\Drive\File;
use Codenom\Framework\Exception\FileSystemException;

class Io
{
    /**
     * @var Codenom\Framework\Driver\File;
     */
    protected $filesystemDriver;

    /**
     * Path to directory where new file must be created
     *
     * @var string
     */
    private $_generationDirectory;

    /**
     * Default code generation directory
     * Should correspond the value from \Codenom\Framework\Drive\File;
     */
    const DEFAULT_DIRECTORY = \WRITEPATH . 'generated';

    /**
     * Constructor Class
     * @param null|string $generationDirectory
     */
    public function __construct($generationDirectory = null)
    {
        $this->filesystemDriver = new File();
        $this->initGeneratorDirectory($generationDirectory);
    }

    /**
     * Get path to generation directory
     *
     * @param null|string $directory
     * @return string
     */
    protected function initGeneratorDirectory($directory = null)
    {
        if ($directory) {
            $this->_generationDirectory = rtrim($directory, '/') . '/';
        } else {
            $this->_generationDirectory = realpath(__DIR__ . '/../../../../') . '/' . self::DEFAULT_DIRECTORY . '/';
        }
    }


    /**
     * Wrapper for include
     *
     * @param string $fileName
     * @return mixed
     * @codeCoverageIgnore
     */
    public function includeFile($fileName)
    {
        return include $fileName;
    }

    /**
     * @param string $className
     * @return string
     */
    public function getResultFileDirectory($className)
    {
        $fileName = $this->generateResultFileName($className);
        $pathParts = explode('/', $fileName);
        unset($pathParts[count($pathParts) - 1]);

        return implode('/', $pathParts) . '/';
    }
    /**
     * @param string $className
     * @return string
     */
    public function generateResultFileName($className)
    {
        return $this->_generationDirectory . ltrim(str_replace(['\\', '_'], '/', $className), '/') . '.php';
    }
    /**
     * @param string $className
     * @return bool
     */
    public function makeResultFileDirectory($className)
    {
        return $this->_makeDirectory($this->getResultFileDirectory($className));
    }

    /**
     * @param string $fileName
     * @return bool
     */
    public function fileExists($fileName)
    {
        return $this->filesystemDriver->isExists($fileName);
    }

    /**
     * @param string $directory
     * @return bool
     */
    private function _makeDirectory($directory)
    {
        if ($this->filesystemDriver->isWritable($directory)) {
            return true;
        }
        try {
            if (!$this->filesystemDriver->isDirectory($directory)) {
                $this->filesystemDriver->createDirectory($directory);
            }
            return true;
        } catch (FileSystemException $e) {
            return false;
        }
    }
}
