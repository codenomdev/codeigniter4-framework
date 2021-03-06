<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\CLI\Component;

use Codenom\Framework\Drive\File as Files;
use Codenom\Framework\Filesystem\DirectoryList;

class File
{
    const DEFAULT_CHMOD = '0777';

    protected $drive;
    protected $directoryList;
    protected $installationWritableDirectories;
    /**
     * List of current writable directories for installation
     *
     * @var array
     */
    protected $installationCurrentWritableDirectories = [];

    /**
     * List of non-writable paths in a specified directory
     *
     * @var array
     */
    protected $nonWritablePathsInDirectories = [];

    public function __construct()
    {
        $this->drive = new Files();
        $this->directoryList = new DirectoryList();
    }

    /**
     * Retrieve list of required writable directories for installation
     *
     * @return array
     */
    public function getInstallationWritableDirectories()
    {
        if (!$this->installationWritableDirectories) {
            $data = [
                DirectoryList::DEFAULT_WRITEPATH,
                DirectoryList::DEFAULT_GENERATED,
                DirectoryList::GENERATED_APP,
            ];

            foreach ($data as $code) {
                $this->installationWritableDirectories[$code] = $this->directoryList->getPath($code);
            }
        }
        return array_values($this->installationWritableDirectories);
    }

    /**
     * Retrieve list of currently writable directories for installation
     *
     * @return array
     */
    public function getInstallationCurrentWritableDirectories()
    {
        if (!$this->installationCurrentWritableDirectories) {
            foreach ($this->installationWritableDirectories as $code => $path) {
                if ($this->drive->isWritable($code)) {
                    // if ($this->drive->checkRecursiveDirectories($path)) {
                    $this->installationCurrentWritableDirectories[] = $path;
                    // }
                } else {
                    $this->nonWritablePathsInDirectories[$path] = [$path];
                }
            }
        }
        return $this->installationCurrentWritableDirectories;
    }
}
