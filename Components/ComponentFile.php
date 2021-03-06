<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Components;

/**
 * Value-object for files found in components
 */
class ComponentFile
{
    /**
     * Component type
     *
     * @var string
     */
    private $componentType;

    /**
     * Component name
     *
     * @var string
     */
    private $componentName;

    /**
     * Full path
     *
     * @var string
     */
    private $path;

    /**
     * Constructor
     *
     * @param string $componentType
     * @param string $componentName
     * @param string $fullPath
     */
    public function __construct($componentType, $componentName, $fullPath)
    {
        $this->componentType = $componentType;
        $this->componentName = $componentName;
        $this->path = $fullPath;
    }

    /**
     * Get component type
     *
     * @return string
     */
    public function getComponentType()
    {
        return $this->componentType;
    }

    /**
     * Get component name
     *
     * @return string
     */
    public function getComponentName()
    {
        return $this->componentName;
    }

    /**
     * Get full path to the component
     *
     * @return string
     */
    public function getFullPath()
    {
        return $this->path;
    }
}
