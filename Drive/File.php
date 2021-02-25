<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Drive;

use Codenom\Framework\Exception\FileSystemException;
use CodeIgniter\Config\Services;
use Codenom\Framework\Drive\DriverInterface;

class File implements DriverInterface
{
    /**
     * @var string
     */
    protected $schema = '';

    /**
     * Retrieve file contents from given path
     *
     * @param string $path
     * @param string|null $flag
     * @param resource|null $context
     * @return string
     * @throws FileSystemException
     */
    public function fileGetContents($path, $flag = null, $context = null)
    {
        $filename = $this->getScheme() . $path;
        clearstatcache(false, $filename);
        $result = @file_get_contents($filename, $flag, $context);
        if (false === $result) {
            throw new FileSystemException(
                'The contents from the "' . $path . '" file can\'t be read.'
            );
        }
        return $result;
    }

    /**
     * Tells whether the filename is a regular file
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isFile($path)
    {
        $filename = $this->getScheme() . $path;
        clearstatcache(false, $filename);
        $result = @is_file($filename);
        if ($result === null) {
            throw new FileSystemException(
                'An error occurred during "%1" execution.'
            );
        }
        return $result;
    }

    /**
     * Tells whether the filename is a regular directory
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isDirectory($path)
    {
        $filename = $this->getScheme() . $path;
        clearstatcache(false, $filename);
        $result = @is_dir($filename);
        if ($result === null) {
            throw new FileSystemException(
                'An error occurred during "' . $path . '" execution.'
            );
        }
        return $result;
    }

    /**
     * Is file or directory exist in file system
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isExists($path)
    {
        $filename = $this->getScheme() . $path;
        clearstatcache(false, $filename);
        $result = @file_exists($filename);
        if ($result === null) {
            throw new FileSystemException(
                'An error occurred during "%1" execution.'
            );
        }
        return $result;
    }

    /**
     * Check permissions for reading file or directory
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isReadable($path)
    {
        $filename = $this->getScheme() . $path;
        clearstatcache(false, $filename);
        $result = @is_readable($filename);
        if ($result === null) {
            throw new FileSystemException(
                'An error occurred during "%1" execution.'
            );
        }
        return $result;
    }

    /**
     * Check if given path is writable
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isWritable($path)
    {
        $filename = $this->getScheme() . $path;
        clearstatcache(false, $filename);
        $result = @is_writable($filename);
        if ($result === null) {
            throw new FileSystemException(
                'An error occurred during "%1" execution.'
            );
        }
        return $result;
    }

    /**
     * Returns parent directory's path
     *
     * @param string $path
     * @return string
     */
    public function getParentDirectory($path)
    {
        return dirname($this->getScheme() . $path);
    }

    /**
     * Create directory
     *
     * @param string $path
     * @param int $permissions
     * @return bool
     * @throws FileSystemException
     */
    public function createDirectory($path, $permissions = 0777)
    {
        return $this->mkdirRecursive($path, $permissions);
    }

    /**
     * Create a directory recursively taking into account race conditions
     *
     * @param string $path
     * @param int $permissions
     * @return bool
     * @throws FileSystemException
     */
    private function mkdirRecursive($path, $permissions = 0777)
    {
        $path = $this->getScheme() . $path;
        if (is_dir($path)) {
            return true;
        }
        $parentDir = dirname($path);
        while (!is_dir($parentDir)) {
            $this->mkdirRecursive($parentDir, $permissions);
        }
        $result = @mkdir($path, $permissions);
        if (!$result) {
            if (is_dir($path)) {
                $result = true;
            } else {
                throw new FileSystemException(
                    'Directory "%1" cannot be created %2'
                );
            }
        }
        return $result;
    }

    /**
     * Attempts to locate a file by examining the name for a namespace
     * and looking through the PSR-4 namespaced files that we know about.
     *
     * @param string $file   The namespaced file to locate
     * @param string $folder The folder within the namespace that we should look for the file.
     * @param string $ext    The file extension the file should have.
     *
     * @return string|false The path to the file, or false if not found.
     */
    public function readDirectory($file, $folder, $ext = 'php'): string
    {
        try {
            return Services::locator()->locateFile($file, $folder, $ext);
        } catch (\Exception $e) {
            throw new FileSystemException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Searches through all of the defined namespaces looking for a file.
     * Returns an array of all found locations for the defined file.
     *
     * Example:
     *
     *  $locator->search('Config/Routes.php');
     *  // Assuming PSR4 namespaces include foo and bar, might return:
     *  [
     *      'app/Modules/foo/Config/Routes.php',
     *      'app/Modules/bar/Config/Routes.php',
     *  ]
     *
     * @param string  $path
     * @param string  $ext
     * @param boolean $prioritizeApp
     *
     * @return array
     */
    public function search(string $path, string $ext = 'php', bool $prioritizeApp = TRUE)
    {
        return (Services::locator())->search($path, $ext, $prioritizeApp);
    }

    /**
     * Renames a file or directory
     *
     * @param string $oldPath
     * @param string $newPath
     * @param DriverInterface|null $targetDriver
     * @return bool
     * @throws FileSystemException
     */
    public function rename($oldPath, $newPath, DriverInterface $targetDriver = null)
    {
        $result = false;
        $targetDriver = $targetDriver ?: $this;
        if (get_class($targetDriver) == get_class($this)) {
            $result = @rename($this->getScheme() . $oldPath, $newPath);
        } else {
            $content = $this->fileGetContents($oldPath);
            if (false !== $targetDriver->filePutContents($newPath, $content)) {
                $result = $this->deleteFile($newPath);
            }
        }
        if (!$result) {
            throw new FileSystemException(
                'The path "%1" cannot be renamed into "%2" %3'
            );
        }
        return $result;
    }

    /**
     * Write contents to file in given path
     *
     * @param string $path
     * @param string $content
     * @param string|null $mode
     * @return int The number of bytes that were written.
     * @throws FileSystemException
     */
    public function filePutContents($path, $content, $mode = null)
    {
        $result = @file_put_contents($this->getScheme() . $path, $content, $mode);
        if ($result === false) {
            throw new FileSystemException(
                'The specified "' . $path . '" file couldn\'t be written. ' . $content
            );
        }
        return $result;
    }

    /**
     * Delete file
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function deleteFile($path)
    {
        $result = @unlink($this->getScheme() . $path);
        if (!$result) {
            throw new FileSystemException(
                'The "%1" file can\'t be deleted. %2'
            );
        }
        return $result;
    }

    /**
     * Recursive delete directory
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function deleteDirectory($path)
    {
        $exceptionMessages = [];
        $flags = \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS;
        $iterator = new \FilesystemIterator($path, $flags);
        /** @var \FilesystemIterator $entity */
        foreach ($iterator as $entity) {
            try {
                if ($entity->isDir()) {
                    $this->deleteDirectory($entity->getPathname());
                } else {
                    $this->deleteFile($entity->getPathname());
                }
            } catch (FileSystemException $exception) {
                $exceptionMessages[] = $exception->getMessage();
            }
        }

        if (!empty($exceptionMessages)) {
            throw new FileSystemException(
                \implode(' ', $exceptionMessages)
            );
        }

        $fullPath = $this->getScheme() . $path;
        if (is_link($fullPath)) {
            $result = @unlink($fullPath);
        } else {
            $result = @rmdir($fullPath);
        }
        if (!$result) {
            throw new FileSystemException(
                'The directory "' . $path . '" cannot be deleted'
            );
        }
        return $result;
    }

    /**
     * Copy source into destination
     *
     * @param string $source
     * @param string $destination
     * @param DriverInterface|null $targetDriver
     * @return bool
     * @throws FileSystemException
     */
    public function copy($source, $destination, DriverInterface $targetDriver = null)
    {
        $targetDriver = $targetDriver ?: $this;
        if (get_class($targetDriver) == get_class($this)) {
            $result = @copy($this->getScheme() . $source, $destination);
        } else {
            $content = $this->fileGetContents($source);
            $result = $targetDriver->filePutContents($destination, $content);
        }
        if (!$result) {
            throw new FileSystemException(
                'The file or directory "' . $source . '" cannot be copied to "' . $destination . '"'
            );
        }
        return $result;
    }

    /**
     * Create symlink on source and place it into destination
     *
     * @param string $source
     * @param string $destination
     * @param DriverInterface|null $targetDriver
     * @return bool
     * @throws FileSystemException
     */
    public function symlink($source, $destination, DriverInterface $targetDriver = null)
    {
        $result = false;
        if ($targetDriver === null || get_class($targetDriver) == get_class($this)) {
            $result = @symlink($this->getScheme() . $source, $destination);
        }
        if (!$result) {
            throw new FileSystemException(
                'A symlink for "' . $source . '" can\'t be created and placed to "' . $destination . '". %3'
            );
        }
        return $result;
    }

    /**
     * Change permissions of given path
     *
     * @param string $path
     * @param int $permissions
     * @return bool
     * @throws FileSystemException
     */
    public function changePermissions($path, $permissions)
    {
        $result = @chmod($this->getScheme() . $path, $permissions);
        if (!$result) {
            throw new FileSystemException(
                'The permissions can\'t be changed for the "' . $path . '" path.'
            );
        }
        return $result;
    }

    /**
     * Recursively change permissions of given path
     *
     * @param string $path
     * @param int $dirPermissions
     * @param int $filePermissions
     * @return bool
     * @throws FileSystemException
     */
    public function changePermissionsRecursively($path, $dirPermissions, $filePermissions)
    {
        $result = true;
        if ($this->isFile($path)) {
            $result = @chmod($path, $filePermissions);
        } else {
            $result = @chmod($path, $dirPermissions);
        }
        if (!$result) {
            throw new FileSystemException(
                'The permissions can\'t be changed for the "%1" path. %2.'
            );
        }

        $flags = \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS;

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, $flags),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        /** @var \FilesystemIterator $entity */
        foreach ($iterator as $entity) {
            if ($entity->isDir()) {
                $result = @chmod($entity->getPathname(), $dirPermissions);
            } else {
                $result = @chmod($entity->getPathname(), $filePermissions);
            }
            if (!$result) {
                throw new FileSystemException(
                    'The permissions can\'t be changed for the "%1" path. %2.'
                );
            }
        }
        return $result;
    }

    /**
     * Sets access and modification time of file.
     *
     * @param string $path
     * @param int|null $modificationTime
     * @return bool
     * @throws FileSystemException
     */
    public function touch($path, $modificationTime = null)
    {
        if (!$modificationTime) {
            $result = @touch($this->getScheme() . $path);
        } else {
            $result = @touch($this->getScheme() . $path, $modificationTime);
        }
        if (!$result) {
            throw new FileSystemException(
                'The "%1" file or directory can\'t be touched. %2'
            );
        }
        return $result;
    }

    /**
     * Open file
     *
     * @param string $path
     * @param string $mode
     * @return resource file
     * @throws FileSystemException
     */
    public function fileOpen($path, $mode)
    {
        $result = @fopen($this->getScheme() . $path, $mode);
        if (!$result) {
            throw new FileSystemException(
                'File "%1" cannot be opened %2'
            );
        }
        return $result;
    }

    /**
     * Reads the line content from file pointer (with specified number of bytes from the current position).
     *
     * @param resource $resource
     * @param int $length
     * @param string $ending [optional]
     * @return string
     * @throws FileSystemException
     */
    public function fileReadLine($resource, $length, $ending = null)
    {
        // phpcs:disable
        $result = @stream_get_line($resource, $length, $ending);
        // phpcs:enable
        if (false === $result) {
            throw new FileSystemException(
                'File cannot be read %1'
            );
        }

        return $result;
    }

    /**
     * Reads the specified number of bytes from the current position.
     *
     * @param resource $resource
     * @param int $length
     * @return string
     * @throws FileSystemException
     */
    public function fileRead($resource, $length)
    {
        $result = @fread($resource, $length);
        if ($result === false) {
            throw new FileSystemException(
                'File cannot be read %1'
            );
        }
        return $result;
    }

    /**
     * Returns true if pointer at the end of file or in case of exception
     *
     * @param resource $resource
     * @return boolean
     */
    public function endOfFile($resource)
    {
        return feof($resource);
    }

    /**
     * Close file
     *
     * @param resource $resource
     * @return boolean
     * @throws FileSystemException
     */
    public function fileClose($resource)
    {
        $result = @fclose($resource);
        if (!$result) {
            throw new FileSystemException(
                'An error occurred during "%1" fileClose execution.'
            );
        }
        return $result;
    }

    /**
     * Writes data to file
     *
     * @param resource $resource
     * @param string $data
     * @return int
     * @throws FileSystemException
     */
    public function fileWrite($resource, $data)
    {
        $lenData = strlen($data);
        for ($result = 0; $result < $lenData; $result += $fwrite) {
            $fwrite = @fwrite($resource, substr($data, $result));
            if (0 === $fwrite) {
                $this->fileSystemException('Unable to write');
            }
            if (false === $fwrite) {
                $this->fileSystemException(
                    'An error occurred during "%1" fileWrite execution.'
                );
            }
        }

        return $result;
    }

    /**
     * Lock file in selected mode
     *
     * @param resource $resource
     * @param int $lockMode
     * @return bool
     * @throws FileSystemException
     */
    public function fileLock($resource, $lockMode = LOCK_EX)
    {
        $result = @flock($resource, $lockMode);
        if (!$result) {
            throw new FileSystemException(
                'An error occurred during "%1" fileLock execution.'
            );
        }
        return $result;
    }

    /**
     * Unlock file
     *
     * @param resource $resource
     * @return bool
     * @throws FileSystemException
     */
    public function fileUnlock($resource)
    {
        $result = @flock($resource, LOCK_UN);
        if (!$result) {
            throw new FileSystemException(
                'An error occurred during "%1" fileUnlock execution.'
            );
        }
        return $result;
    }

    /**
     * Returns an absolute path for the given one.
     *
     * @param string $basePath
     * @param string $path
     * @param string|null $scheme
     * @return string
     */
    public function getAbsolutePath($basePath, $path, $scheme = null)
    {
        // check if the path given is already an absolute path containing the
        // basepath. so if the basepath starts at position 0 in the path, we
        // must not concatinate them again because path is already absolute.
        if (0 === strpos($path, $basePath)) {
            return $this->getScheme($scheme) . $path;
        }

        return $this->getScheme($scheme) . $basePath . ltrim($this->fixSeparator($path), '/');
    }

    /**
     * Retrieves relative path
     *
     * @param string $basePath
     * @param string $path
     * @return string
     */
    public function getRelativePath($basePath, $path = null)
    {
        $path = $this->fixSeparator($path);
        if (strpos($path, $basePath) === 0 || $basePath == $path . '/') {
            $result = substr($path, strlen($basePath));
        } else {
            $result = $path;
        }
        return $result;
    }

    /**
     * Fixes path separator.
     *
     * Utility method.
     *
     * @param string $path
     * @return string
     */
    protected function fixSeparator($path)
    {
        return str_replace('\\', '/', $path);
    }

    /**
     * Flushes the output
     *
     * @param resource $resource
     * @return bool
     * @throws FileSystemException
     */
    public function fileFlush($resource)
    {
        $result = @fflush($resource);
        if (!$result) {
            throw new FileSystemException(
                'An error occurred during "%1" fileFlush execution.'
            );
        }
        return $result;
    }
    /**
     * Get real path
     *
     * @param string $path
     *
     * @return string|bool
     */
    public function getRealPath($path)
    {
        return realpath($path);
    }

    /**
     * Return correct path for link
     *
     * @param string $path
     * @return mixed
     */
    public function getRealPathSafety($path)
    {
        if (strpos($path, DIRECTORY_SEPARATOR . '.') === false) {
            return $path;
        }

        //Removing redundant directory separators.
        $path = preg_replace(
            '/\\' . DIRECTORY_SEPARATOR . '\\' . DIRECTORY_SEPARATOR . '+/',
            DIRECTORY_SEPARATOR,
            $path
        );
        $pathParts = explode(DIRECTORY_SEPARATOR, $path);
        if (end($pathParts) == '.') {
            $pathParts[count($pathParts) - 1] = '';
        }
        $realPath = [];
        foreach ($pathParts as $pathPart) {
            if ($pathPart == '.') {
                continue;
            }
            if ($pathPart == '..') {
                array_pop($realPath);
                continue;
            }
            $realPath[] = $pathPart;
        }
        return implode(DIRECTORY_SEPARATOR, $realPath);
    }

    /**
     * Throw a FileSystemException with a Phrase of message and optional arguments
     *
     * @param string $message
     * @param array $arguments
     * @return void
     * @throws FileSystemException
     */
    private function fileSystemException($message, $arguments = [])
    {
        throw new FileSystemException($message, $arguments);
    }

    /**
     * Return path with scheme
     *
     * @param null|string $scheme
     * @return string
     */
    protected function getScheme($scheme = null)
    {
        return $scheme ? $scheme . '://' : '';
    }
}
