<?php

namespace Codenom\Framework\Config;

use CodeIgniter\Config\BaseConfig;

class Cache extends BaseConfig
{
    /*
	|--------------------------------------------------------------------------
	| Set Compile Cache Smarty
	|--------------------------------------------------------------------------
	|
	| The path to where cache files should be stored, if using a file-based
	| system.
	|
	*/
    public $compileCacheDir = \WRITEPATH . 'cache/smarty/template/cache';

    /*
	|--------------------------------------------------------------------------
	| Set Compile Cache Smarty
	|--------------------------------------------------------------------------
	|
	| The path to where cache files should be stored, if using a file-based
	| system.
	|
	*/
    public $setCacheDir = \WRITEPATH . 'cache/smarty/template';

    /*
	|--------------------------------------------------------------------------
	| Primary Handler
	|--------------------------------------------------------------------------
	|
	| The name of the preferred handler that should be used. If for some reason
	| it is not available, the $backupHandler will be used in its place.
	|
	*/
    public $handler = 'file';

    /*
	|--------------------------------------------------------------------------
	| Backup Handler
	|--------------------------------------------------------------------------
	|
	| The name of the handler that will be used in case the first one is
	| unreachable. Often, 'file' is used here since the filesystem is
	| always available, though that's not always practical for the app.
	|
	*/
    public $backupHandler = 'dummy';

    /*
	|--------------------------------------------------------------------------
	| Cache Directory Path
	|--------------------------------------------------------------------------
	|
	| The path to where cache files should be stored, if using a file-based
	| system.
	|
	*/
    public $storePath = WRITEPATH . 'cache/';
}
