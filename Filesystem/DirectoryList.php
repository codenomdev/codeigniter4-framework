<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Filesystem;

class DirectoryList
{
    const DEFAULT_WRITEPATH = 'writable';
    const DEFAULT_GENERATED = 'generated';
    const GENERATED_APP = 'app';
    const PATH = \ROOTPATH;
    const FILE_AUTOLOAD = 'Autoload.php';

    /**
     * Directories configurations
     *
     * @var array
     */
    private $directories;

    public function __construct()
    {
        $this->directories = static::getDefaultConfig();
    }

    /**
     * Gets a filesystem path of a directory
     *
     * @param string $code
     * @return string
     * @throws \Codenom\Framework\Exception\FileSystemException
     */
    public function getPath($code)
    {
        $this->assertCode($code);
        return $this->directories[$code][self::PATH];
    }

    /**
     * Predefined types/paths
     *
     * @return array
     */
    public static function getDefaultConfig()
    {
        $result = [
            SELF::DEFAULT_WRITEPATH => [SELF::PATH => \WRITEPATH],
            SELF::DEFAULT_GENERATED => [SELF::PATH => \WRITEPATH . SELF::DEFAULT_GENERATED],
            SELF::GENERATED_APP => [SELF::PATH => \WRITEPATH . SELF::DEFAULT_GENERATED . \DIRECTORY_SEPARATOR . SELF::GENERATED_APP]
        ];

        return $result;
    }

    /**
     * Asserts that specified directory code is in the registry
     *
     * @param string $code
     * @throws \Codenom\Framework\Exception\FileSystemException
     * @return void
     */
    private function assertCode($code)
    {
        if (!isset($this->directories[$code])) {
            throw new \Codenom\Framework\Exception\FileSystemException(
                \sprintf('Unknown directory type: "%s"', $code)
            );
        }
    }
}
