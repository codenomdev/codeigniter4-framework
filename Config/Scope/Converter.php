<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config\Scope;

class Converter implements \Codenom\Framework\Config\ConverterInterface
{
    /**
     * Convert config data
     *
     * @param array $source
     * @return array
     */
    public function convert($source)
    {
        $output = [];
        foreach ($source as $key => $value) {
            $this->_setArrayValue($output, $key, $value);
        }
        return $output;
    }

    /**
     * Set array value by path
     *
     * @param array &$container
     * @param string $path
     * @param string $value
     * @return void
     */
    protected function _setArrayValue(array &$container, $path, $value)
    {
        $segments = explode('/', $path);
        $currentPointer = &$container;
        foreach ($segments as $segment) {
            if (!isset($currentPointer[$segment])) {
                $currentPointer[$segment] = [];
            }
            $currentPointer = &$currentPointer[$segment];
        }
        $currentPointer = $value;
    }
}
