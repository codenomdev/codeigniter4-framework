<?php

namespace Codenom\Framework\Libraries;

require_once(\ROOTPATH . 'vendor/smarty/smarty/libs/Autoloader.php');

use \CodeIgniter\Config\Services;
use CodeIgniter\View\Exceptions\ViewException;
use \Smarty_Autoloader;

Smarty_Autoloader::register();

// use  as Smartys;

class Smarty extends \Smarty
{
    /**
     * view path
     * 
     * @var string
     */
    protected $viewPath;

    /**
     * loader
     * 
     * @var mixed
     */
    protected $loader;
    /**
     * debug mode
     * Setting this to true enables the debug-console.
     *
     * @var boolean
     */
    public $debugging = FALSE;

    /**
     * This determines if debugging is enable-able from the browser.
     * <ul>
     *  <li>NONE => no debugging control allowed</li>
     *  <li>URL => enable debugging when SMARTY_DEBUG is found in the URL.</li>
     * </ul>
     *
     * @var string
     */
    public $debugging_ctrl = 'NONE';

    /**
     * When set, smarty uses this value as error_reporting-level.
     *
     * @var int
     */
    public $error_reporting = null;

    /**
     * resource type used if none given
     * Must be an valid key of $registered_resources.
     *
     * @var string
     */
    public $default_resource_type = 'file';

    /**
     * caching type
     * Must be an element of $cache_resource_types.
     *
     * @var string
     */
    public $caching_type = 'file';

    /**
     * config type
     *
     * @var string
     */
    public $default_config_type = 'file';

    /**
     * check If-Modified-Since headers
     *
     * @var boolean
     */
    public $cache_modified_check = false;

    /**
     * registered plugins
     *
     * @var array
     */
    public $registered_plugins = array();

    /**
     * registered objects
     *
     * @var array
     */
    public $registered_objects = array();

    /**
     * registered classes
     *
     * @var array
     */
    public $registered_classes = array();

    /**
     * registered filters
     *
     * @var array
     */
    public $registered_filters = array();

    /**
     * registered resources
     *
     * @var array
     */
    public $registered_resources = array();

    /**
     * registered cache resources
     *
     * @var array
     */
    public $registered_cache_resources = array();

    /**
     * autoload filter
     *
     * @var array
     */
    public $autoload_filters = array();

    /**
     * default modifier
     *
     * @var array
     */
    public $default_modifiers = array();

    /**
     * autoescape variable output
     *
     * @var boolean
     */
    public $escape_html = false;

    public function __construct(string $viewPath = null, $loader = null)
    {
        $this->viewPath = rtrim($viewPath, '\\/ ') . DIRECTORY_SEPARATOR;
        $this->loader   = $loader ?? Services::locator();
        parent::__construct();

        parent::setTemplateDir($viewPath);
        parent::setCompileDir((new \Codenom\Framework\Config\Cache())->compileCacheDir)->setCacheDir((new \Codenom\Framework\Config\Cache())->setCacheDir);
    }

    public function view($tpl_name)
    {
        // if (\substr($tpl_name, -4) != '.tpl') {
        //     $tpl_name .= '.tpl';
        // }
        parent::display($this->_view($tpl_name));
    }

    protected function _view($tpl_name)
    {
        $fileExt = \pathinfo($tpl_name, PATHINFO_EXTENSION);
        $realPath = empty($fileExt) ? $tpl_name . '.tpl' : $tpl_name;
        $file = $this->viewPath . $realPath;
        if (!\is_file($file)) {
            $file = $this->loader->locateFile($file, 'Views', empty($fileExt) ? 'tpl' : $fileExt);
        }

        if (empty($file)) {
            throw ViewException::forInvalidFile($tpl_name);
        }


        return $file;
    }
}
