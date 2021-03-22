<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Factory;

class ComponentFactory
{
    /**
     * Theme name
     */
    protected $themeName = null;

    /**
     * Charset Default
     */
    protected $charsetDefault =  null;

    protected $themePath = null;

    public function getName()
    {
        return $this->rootItemName;
    }
}
