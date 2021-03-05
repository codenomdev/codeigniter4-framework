<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Controllers;

/**
 * Class BackendController
 *
 * BackendController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BackendController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package Codenom/Framework
 */

use CodeIgniter\Controller;
use CodeIgniter\Events\Events;
use Codenom\Framework\Admin\Breadcrumb\BreadcrumbFactory;
use Codenom\Framework\Views\Menu\MenuRepository;

class BackendController extends Controller
{
    /**
     * @var \Config\Services::renderer()
     */
    protected $renderer;

    /**
     * Meta title
     * @var string
     */
    protected $metaTitle = '';

    /**
     * Display title on page header
     * @var string
     */
    protected $displayTitle = '';

    /**
     * Display sub title on breadcrumb
     * @var string
     */
    protected $subDisplayTitle = '';

    /**
     * Clikable Breadcrumb
     * @var bool
     */
    private $clikable = TRUE;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * @var \CodeIgniter\HTPP\RequestInterface
     */
    protected $request;

    /**
     * @var \CodeIgniter\HTTP\ResponseInterface
     */
    protected $response;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var array;
     */
    private $setData = [];

    /**
     * @var string
     */
    private $render = '';

    /**
     * @var array
     */
    private $setVar = [];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        $this->session = \Config\Services::session();
        $this->request = $request;
        $this->logger = $logger;
        $this->response = $response;
        \helper(['admin', 'html']);
        $this->renderer = \Config\Services::renderer();
        $this->getData();
    }

    /**
     * Sets several pieces of view data at once.
     *
     * @param array  $data
     * @param string $context The context to escape it for: html, css, js, url
     *                        If null, no escaping will happen
     *
     * @return mixed
     */
    protected function setData(array $data = [], string $context = null)
    {
        $this->setData = $this->renderer->setData($data, $context);
        return $this;
    }

    /**
     * Sets a single piece of view data.
     *
     * @param string $name
     * @param mixed  $value
     * @param string $context The context to escape it for: html, css, js, url
     *                        If null, no escaping will happen
     *
     * @return mixed
     */
    protected function setVar(string $name, $value, string $context = null)
    {
        $this->setVar = $this->renderer->setVar($name, $value, $context);
        return $this;
    }

    /**
     * Builds the output based upon a file name and any
     * data that has already been set.
     *
     * Valid $options:
     *     - cache 		number of seconds to cache for
     *  - cache_name	Name to use for cache
     *
     * @param string       $view
     * @param array|null   $options
     * @param boolean|null $saveData
     *
     * @return string
     */
    protected function render(string $view = '', array $option = [], bool $saveData = false)
    {
        $this->render = $this->renderer->render($view, $option, $saveData);
        return $this->render;
    }

    private function menuLoaded()
    {
        $menu = new \Codenom\Framework\Admin\Menu\PrimaryNavbarFactory();
        $adminMenu = new \Codenom\Framework\Admin\Menu\AdminMenuFactory();
        $repository = new \Codenom\Framework\Admin\Menu\MenuRepository($menu, $adminMenu);
        Events::trigger('adminAreaPrimaryNavbar', $repository->primaryNavbar());
        // Events::trigger('adminAreaSidebar', (new ));
        return $repository;
    }

    protected function addToBreadCrumb()
    {
        $getBreadcrumb = new BreadcrumbFactory();
        $uriSegments = $this->request->uri->getSegments();
        foreach ($uriSegments as $key => $value) {
            $text = \ucwords($value);
            $link = $value;
            $getBreadcrumb->addToBreadcrumb($link, $text);
        }
        return $getBreadcrumb;
    }

    protected function metaTitle(string $metaTitle = ''): string
    {

        $getUrl = $this->request->uri->getSegments();

        if ($this->metaTitle) {
            $this->metaTitle = $metaTitle;
        }

        foreach ($getUrl as $key => $val) {
            $keys = array_keys($getUrl);
            if (end($keys) == $key) {
                $this->metaTitle .= str_replace(' / ', '', $val);
            } else {
                $this->metaTitle .= $val . ' / ';
            }
        }
        return \ucwords($this->metaTitle);
    }

    protected function setDisplayTitle(string $displayTitle = ''): string
    {
        $this->displayTitle = $displayTitle;
        return $this->displayTitle;
    }

    protected function getDisplayTitle()
    {
        return $this->displayTitle;
    }

    protected function subDisplayTitle()
    {
        return $this->subDisplayTitle;
    }

    protected function getData()
    {
        $setDefault = $this->setVar('metaTitle', $this->metaTitle(), 'html')
            ->setVar('displayTitle', $this->getDisplayTitle(), 'html')
            ->setVar('subDisplayTitle', $this->subDisplayTitle(), 'html')
            ->setData([
                'navbarMenu' => \Codenom\Framework\Libraries\Menu\Item::sort($this->menuLoaded()->primaryNavbar()),
                'breadcrumb' => $this->addToBreadCrumb()->getBreadcrumb(),
            ]);
        return $setDefault;
    }
}
