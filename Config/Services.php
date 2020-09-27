<<<<<<< HEAD
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
=======
<?php

namespace Codenom\Framework\Config;

class Services
{
    public function test()
    {
        return 'test vendor';
    }
    public function test1()
    {
        return 'test vendor';
    }
}
>>>>>>> 72d3c4b8623df9d09b4585a1a063cd451eace84c
