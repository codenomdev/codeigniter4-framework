<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Drive;

interface DriverInterface
{
    /**
     * Permissions to give read/write/execute access to owner and owning group, but not to all users
     *
     * @deprecated
     */
    const WRITEABLE_DIRECTORY_MODE = 0770;

    /**
     * Permissions to give read/write access to owner and owning group, but not to all users
     *
     * @deprecated
     */
    const WRITEABLE_FILE_MODE = 0660;

    /**
     * Retrieve file contents from given path
     *
     * @param string $path
     * @param string|null $flag
     * @param resource|null $context
     * @return string
     * @throws FileSystemException
     */
    public function fileGetContents($path, $flag = null, $context = null);

    /**
     * Put contents into given file
     *
     * @param string $path
     * @param string $content
     * @param string|null $mode
     * @return int The number of bytes that were written.
     * @throws FileSystemException
     */
    public function filePutContents($path, $content, $mode = null);

    /**
     * Tells whether the filename is a regular file
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isFile($path);

    /**
     * Check if given path is writable
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isWritable($path);

    /**
     * Is file or directory exist in file system
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isExists($path);

    /**
     * Tells whether the filename is a regular directory
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isDirectory($path);

    /**
     * Check permissions for reading file or directory
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function isReadable($path);

    /**
     * Returns parent directory's path
     *
     * @param string $path
     * @return string
     */
    public function getParentDirectory($path);

    /**
     * Create directory
     *
     * @param string $path
     * @param int $permissions
     * @return bool
     * @throws FileSystemException
     */
    public function createDirectory($path, $permissions = 0777);

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
    public function readDirectory($file, $folder, $ext = 'php');

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
    public function search(string $path, string $ext, bool $prioritizeApp);

    /**
     * Renames a file or directory
     *
     * @param string $oldPath
     * @param string $newPath
     * @param DriverInterface|null $targetDriver
     * @return bool
     * @throws FileSystemException
     */
    public function rename($oldPath, $newPath, DriverInterface $targetDriver = null);

    /**
     * Copy source into destination
     *
     * @param string $source
     * @param string $destination
     * @param DriverInterface|null $targetDriver
     * @return bool
     * @throws FileSystemException
     */
    public function copy($source, $destination, DriverInterface $targetDriver = null);

    /**
     * Create symlink on source and place it into destination
     *
     * @param string $source
     * @param string $destination
     * @param DriverInterface|null $targetDriver
     * @return bool
     * @throws FileSystemException
     */
    public function symlink($source, $destination, DriverInterface $targetDriver = null);

    /**
     * Delete file
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function deleteFile($path);

    /**
     * Delete directory
     *
     * @param string $path
     * @return bool
     * @throws FileSystemException
     */
    public function deleteDirectory($path);

    /**
     * Change permissions of given path
     *
     * @param string $path
     * @param int $permissions
     * @return bool
     * @throws FileSystemException
     */
    public function changePermissions($path, $permissions);

    /**
     * Recursively hange permissions of given path
     *
     * @param string $path
     * @param int $dirPermissions
     * @param int $filePermissions
     * @return bool
     * @throws FileSystemException
     */
    public function changePermissionsRecursively($path, $dirPermissions, $filePermissions);

    /**
     * Sets access and modification time of file.
     *
     * @param string $path
     * @param int|null $modificationTime
     * @return bool
     * @throws FileSystemException
     */
    public function touch($path, $modificationTime = null);

    /**
     * Open file
     *
     * @param string $path
     * @param string $mode
     * @return resource
     * @throws FileSystemException
     */
    public function fileOpen($path, $mode);

    /**
     * Reads the line content from file pointer (with specified number of bytes from the current position).
     *
     * @param resource $resource
     * @param int $length
     * @param string $ending [optional]
     * @return string
     * @throws FileSystemException
     */
    public function fileReadLine($resource, $length, $ending = null);

    /**
     * Reads the specified number of bytes from the current position.
     *
     * @param resource $resource
     * @param int $length
     * @return string
     * @throws FileSystemException
     */
    public function fileRead($resource, $length);

    /**
     * Returns true if pointer at the end of file or in case of exception
     *
     * @param resource $resource
     * @return boolean
     */
    public function endOfFile($resource);

    /**
     * Close file
     *
     * @param resource $resource
     * @return boolean
     * @throws FileSystemException
     */
    public function fileClose($resource);

    /**
     * Writes data to file
     *
     * @param resource $resource
     * @param string $data
     * @return int
     * @throws FileSystemException
     */
    public function fileWrite($resource, $data);

    /**
     * Flushes the output
     *
     * @param resource $resource
     * @return bool
     * @throws FileSystemException
     */
    public function fileFlush($resource);

    /**
     * Lock file in selected mode
     *
     * @param resource $resource
     * @param int $lockMode
     * @return bool
     * @throws FileSystemException
     */
    public function fileLock($resource, $lockMode = LOCK_EX);

    /**
     * Unlock file
     *
     * @param resource $resource
     * @return bool
     * @throws FileSystemException
     */
    public function fileUnlock($resource);

    /**
     * @param string $basePath
     * @param string $path
     * @param string|null $scheme
     * @return mixed
     */
    public function getAbsolutePath($basePath, $path, $scheme = null);

    /**
     * @param string $path
     * @return mixed
     */
    public function getRealPath($path);

    /**
     * Return correct path for link
     *
     * @param string $path
     * @return mixed
     */
    public function getRealPathSafety($path);

    /**
     * @param string $basePath
     * @param null $path
     * @return mixed
     */
    public function getRelativePath($basePath, $path = null);
}
