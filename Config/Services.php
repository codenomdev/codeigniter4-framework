<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Config;

use CodeIgniter\Config\BaseService;
use Codenom\Framework\Config\ValidationConfig;
use CodeIgniter\Validation\Validation;
use Codenom\Framework\Views\Result\Render;
use Config\View as ViewConfig;

class Services extends BaseService
{
    /**
     * The Validation class provides tools for validating input data.
     *
     * @param ValidationConfig|null $config
     * @param boolean               $getShared
     *
     * @return Validation
     */
    public static function validation($config = null, bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('validation', $config);
        }

        $config = $config ?? config('ValidationConfig');

        return new Validation($config, \Config\Services::renderer());
    }

    /**
     * The Renderer class is the class that actually displays a file to the user.
     * The default View class within CodeIgniter is intentionally simple, but this
     * service could easily be replaced by a template engine if the user needed to.
     *
     * @param string|null     $viewPath
     * @param ViewConfig|null $config
     * @param boolean         $getShared
     *
     * @return View
     */
    public static function render(string $viewPath = null, ViewConfig $config = null, bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('render', $viewPath, $config);
        }

        $viewPath = $viewPath ?: config('Paths')->viewDirectory;
        $config   = $config ?? config('View');

        return new Render($config, $viewPath, static::locator(), CI_DEBUG, static::logger());
    }
}
