<?php

namespace Codenom\Framework\Config;

use CodeIgniter\Config\Services as CoreServices;
use Codenom\Components\Config\View as ViewConfig;
use Codenom\Components\Views\View;

class Services extends CoreServices
{
    // public static function SmartyEngine(string $viewPath = NULL, Smarty $config = null,  $getShared = true)
    // {
    //     if ($getShared) {
    //         return static::getSharedInstance('SmartyEngine', $viewPath, $config);
    //     }
    //     $viewPath = $viewPath ?: config('Paths')->viewDirectory;
    //     $config   = $config ?? config('View');
    //     return new Smarty($viewPath, static::locator());
    // }

    /**
     * The Renderer class is the class that actually displays a file to the user.
     * The default View class within CodeIgniter is intentionally simple, but this
     * service could easily be replaced by a template engine if the user needed to.
     *
     * @param string|null       $viewPath
     * @param \Config\View|null $config
     * @param boolean           $getShared
     *
     * @return \Codenom\Components\Views\View
     */
    public static function View(string $viewPath = null, ViewConfig $config = null, bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('View', $viewPath, $config);
        }

        $viewPath = $viewPath ?: config('Paths')->viewDirectory;
        $config   = $config ?? config('View');

        return new View($config, $viewPath, static::locator(), CI_DEBUG, static::logger());
    }
}
