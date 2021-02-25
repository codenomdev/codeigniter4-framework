<?php

namespace Codenom\Framework\Code;

class NameBuilders
{
    /**
     * Builds namespace + classname out of the parts array
     *
     * Split every part into pieces by _ and \ and uppercase every piece
     * Then join them back using \
     *
     * @param string[] $parts
     * @return string
     */
    public function buildClassName($parts)
    {
        $separator = '\\';
        $string = join($separator, $parts);
        $string = str_replace('_', $separator, $string);
        $className = ucwords($string, $separator);
        return $className;
    }

    public function buildDirectoryNameSpace($parts)
    {
        $seperator = '/';
        $string = str_replace('\\', $seperator, $parts);
        $directory = ucwords($string);
        return $directory;
    }
}
