<?php

namespace Codenom\Framework\Config;

use CodeIgniter\Config\Services as CoreServices;
use Codenom\Framework\Libraries\Smarty;

class Services extends CoreServices
{
    public static function SmartyEngine(string $viewPath = NULL, Smarty $config = null,  $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('SmartyEngine', $viewPath, $config);
        }
        $viewPath = $viewPath ?: config('Paths')->viewDirectory;
        $config   = $config ?? config('View');
        return new Smarty($viewPath, static::locator());
    }
}
