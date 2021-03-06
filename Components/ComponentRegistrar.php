<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Components;

use Exception;

/**
 * Provides ability to statically register components.
 *
 * @api
 */
class ComponentRegistrar implements ComponentRegistrarInterface
{
    const MODULE = 'Code';
    const LANGUAGE = 'Language';

    private static $paths = [
        SELF::MODULE => [],
        SELF::LANGUAGE => [],
    ];

    /**
     * Sets the location of a component.
     *
     * @param string $type component type
     * @param string $componentName Fully-qualified component name
     * @param string $path Absolute file path to the component
     * @throws \LogicException
     * @return void
     */
    public static function register($type, $componentName, $path)
    {
        self::validateType($type);
        if (isset(self::$paths[$type][$componentName])) {
            throw new \Exception(
                ucfirst($type) . ' \'' . $componentName . '\' from \'' . $path . '\' '
                    . 'has been already defined in \'' . self::$paths[$type][$componentName] . '\'.'
            );
        }
        self::$paths[$type][$componentName] = str_replace('\\', '/', $path);
    }

    /**
     * @inheritdoc
     */
    public function getPaths($type)
    {
        self::validateType($type);
        return self::$paths[$type];
    }

    /**
     * @inheritdoc
     */
    public function getPath($type, $componentName)
    {
        self::validateType($type);
        return self::$paths[$type][$componentName] ?? null;
    }

    private static function validateType($type)
    {
        if (!isset(self::$paths[$type])) {
            throw new Exception('\'' . $type . '\' is not a valid component type');
        }
    }
}
