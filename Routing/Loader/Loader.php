<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Routing\Loader;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Codenom\Framework\Drive\File;
use Codenom\Framework\Routing\Element;
use Codenom\Framework\Code\NameBuilders;
use Codenom\Framework\Config\Services;
use Codenom\Framework\Routing\RouteFactory;

class Loader
{
    /**
     * @var Codenom\Framework\Drive\File
     */
    protected $fileLocator;

    /**
     * @var Symfony\Component\Yaml\Parser
     */
    protected $yamlParser;

    /**
     * @var Codenom\Framework\Code\NameBuilders
     */
    protected $nameBuilder;
    /**
     * Available key
     */
    const AVAILABLE_KEYS = [
        'id', 'options', 'controller', 'method', 'namespace', 'filter', 'as'
    ];

    const TYPE_ID = ['backend', 'frontend'];
    /**
     * Constructor Class
     * 
     * @var Codenom\Framework\Drive\File
     * @var Symfony\Component\Yaml\Parser
     * @var Codenom\Framework\Code\NameBuilders
     */
    public function __construct()
    {
        $this->fileLocator = new File();
        $this->yamlParser = new Parser();
        $this->nameBuilder = new NameBuilders();
        $this->route = Services::routes(true);
    }

    /**
     * Loads a Yaml file.
     *
     * @param string      $file A Yaml file path
     * @param string|null $type The resource type
     *
     * @return RouteCollection A RouteCollection instance
     *
     * @throws \InvalidArgumentException When a route can't be parsed because YAML is invalid
     */
    public function load($file, string $type = null)
    {
        $file = Element::PATH_MODULE . $file;
        $path = $this->fileLocator->isExists($file);

        if ($path === false) {
            throw new \InvalidArgumentException(sprintf('File "%s" not found.', $file));
        }

        if (null === $this->yamlParser) {
            $this->yamlParser = new Parser();
        }

        try {
            $parsedConfig = $this->yamlParser->parseFile($file, Yaml::PARSE_CONSTANT);
        } catch (ParseException $e) {
            throw new \InvalidArgumentException(sprintf('The file "%s" does not contain valid YAML: ', $path) . $e->getMessage(), 0, $e);
        }

        $collection = Services::routes();

        // empty file
        if (null === $parsedConfig) {
            return;
        }

        // not an array
        if (!\is_array($parsedConfig)) {
            throw new \InvalidArgumentException(sprintf('The file "%s" must contain a YAML array.', $file));
        }

        $content = [];

        foreach ($parsedConfig as $name => $config) {
            $this->validate($config, $name, $file);
            $this->parseRoute($collection, $name, $config, $file);
            // $content[$name] = $config;
        }

        return $collection;
    }

    /**
     * Parses a route and adds it to the RouteCollection.
     *
     * @param string $name   Route name
     * @param array  $config Route definition
     * @param string $path   Full path of the YAML file being processed
     */
    protected function parseRoute($collection, $name, $config, $path)
    {
        $method = $config['method'] ?? 'add';
        $options = $config['options'] ?? [];

        if (isset($config['as']) || isset($config['options']['as'])) {
            $name = $config['as'] ?? $config['options']['as'];
        }

        if ($collection instanceof RouteFactory) {
            $collection->create($method, $name, $config['controller'], $options);
        }

        return $collection;
    }

    /**
     * Validates the route configuration.
     *
     * @param array  $config A resource config
     * @param string $name   The config key
     * @param string $path   The loaded file path
     *
     * @throws \InvalidArgumentException If one of the provided config keys is not supported,
     *                                   something is missing or the combination is nonsense
     */
    protected function validate($config, string $name, string $path)
    {
        if (!\is_array($config)) {
            throw new \InvalidArgumentException(sprintf('The definition of "%s" in "%s" must be a YAML array.', $name, $path));
        }

        if ($extraKeys = array_diff(array_keys($config), Self::AVAILABLE_KEYS)) {
            throw new \InvalidArgumentException(sprintf('The routing file "%s" contains unsupported keys for "%s": "%s". Expected one of: "%s".', $path, $name, implode('", "', $extraKeys), implode('", "', self::AVAILABLE_KEYS)));
        }

        if (\array_key_exists('id', $config) === false) {
            throw new \InvalidArgumentException(sprintf('Unknown tag "id" used in file "%s".', $path));
        }

        $typeId = $config['id'];

        if ($typeId !== 'backend' && $typeId !== 'frontend') {
            throw new \InvalidArgumentException(sprintf('The routing file "%s" contains unsupported keys for "%s": "%s". Expected one of: "%s".', $path, $name, $typeId, implode('", "', self::TYPE_ID)));
        }
    }

    // protected function routeParse($value)
    // {
    //     if (isset($value['method']) === 'get') {
    //         $this->route->get($value['path'], $value['controller'], ['namespace' => 'Codenom\Dashboard\Admin\Controllers']);
    //     }

    //     // return
    // }

    /**
     * Builds namespace + classname out of the parts array
     *
     * Split every part into pieces by _ and \ and uppercase every piece
     * Then join them back using \
     *
     * @param string[] $parts
     * @return string
     */
    protected function buildClassName(string $className)
    {
        return $this->nameBuilder->buildClassName([$className]);
    }
}
