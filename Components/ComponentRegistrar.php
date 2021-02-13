<?php

namespace Codenom\Framework\Components;

// use CodeIgniter\Autoloader\FileLocator;
use Exception;

class ComponentRegistrar implements ComponentRegistrarInterface
{
    const MODULE = 'Modules';

    private static $paths = [
        SELF::MODULE => [],
    ];

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
