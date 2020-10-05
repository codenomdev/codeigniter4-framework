<?php

namespace Codenom\Framework\Views\Templates;

class Plugins
{
    /**
     * Wrap helper function to use as view plugin.
     *
     * @param array $params
     *
     * @return string
     */

    public static function baseUrl(array $params = [])
    {
        return base_url(...$params);
    }
}
