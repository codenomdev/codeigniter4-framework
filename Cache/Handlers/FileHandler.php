<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Cache\Handlers;

use CodeIgniter\Cache\Handlers\FileHandler as FileHandlerCI;
use CodeIgniter\Cache\Exceptions\CacheException;
use Config\Cache;
use Codenom\Framework\Cache\Element;

class FileHandler extends FileHandlerCI
{
    /**
     * Prefixed to all cache names.
     *
     * @var string
     */
    protected $prefix;

    /**
     * Where to store cached files on the disk.
     *
     * @var string
     */
    protected $path;

    /**
     * Mode for the stored files.
     * Must be chmod-safe (octal).
     *
     * @var integer
     *
     * @see https://www.php.net/manual/en/function.chmod.php
     */
    protected $mode;

    /**
     * Constructor.
     *
     * @param  Cache $config
     * @throws CacheException
     */
    public function __construct(Cache $config)
    {
        if (!property_exists($config, 'file')) {
            $config->file = [
                'storePath' => $config->storePath ?? Element::DEFAULT_PATH,
                'mode'      => Element::MODE,
            ];
        }

        $this->path = !empty($config->file['storePath']) ? $config->file['storePath'] : Element::DEFAULT_PATH;
        $this->path = rtrim($this->path, '/') . '/';

        if (!is_really_writable($this->path)) {
            throw CacheException::forUnableToWrite($this->path);
        }

        $this->mode   = $config->file['mode'] ?? Element::MODE;
        $this->prefix = (string) $config->prefix;
    }
}
