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

class BackendController extends Controller
{
    /**
     * @var \Config\Services::renderer()
     */
    protected $render;

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
    protected $clikable = TRUE;

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
        $this->render = \Config\Services::renderer();
        $this->getData();
    }

    protected function menuLoaded()
    {
        $menu = new \Codenom\Framework\Admin\Menu\PrimaryNavbarFactory();
        $adminMenu = new \Codenom\Framework\Admin\Menu\AdminMenuFactory();
        $repository = new \Codenom\Framework\Admin\Menu\MenuRepository($menu, $adminMenu);
        Events::trigger('adminAreaPrimaryNavbar', $repository->primaryNavbar());
        Events::trigger('adminAreaSidebar', $repository->adminMenu());
        return $repository;
    }

    public function addToBreadCrumb()
    {
        $getBreadcrumb = new BreadcrumbFactory();
        // $getTotal = $this->request->uri->getTotalSegments();
        // for ($i = 1; $getTotal > $i; $i++) {
        //     $link = $this->request->uri->getSegment($getTotal);
        //     $label = \ucfirst($this->request->uri->getSegment($getTotal));
        //     $getBreadcrumb->addToBreadcrumb($link, $label);
        // }
        $uriSegments = $this->request->uri->getSegments();
        // $crumbs = array_filter($uriSegments);
        // SUBTRACT 1 FROM COUNT IF THE LAST LINK IS TO NOT BE A LINK
        // $count = count($crumbs);
        // if ($this->clikable) {
        //     $count = count($crumbs);
        // }
        foreach ($uriSegments as $key => $value) {
            $text = \ucwords($value);
            $link = $value;
            $getBreadcrumb->addToBreadcrumb($link, $text);
        }
        return $getBreadcrumb;
    }
    public function metaTitle(string $metaTitle = ''): string
    {

        $getUrl = $this->request->uri->getSegments();

        if ($this->metaTitle) {
            $this->metaTitle = $metaTitle;
        }

        foreach ($getUrl as $key => $val) {
            $keys = array_keys($getUrl);
            if (end($keys) == $key) {
                // $this->metaTitle .= ';w';
                $this->metaTitle .= str_replace(' / ', '', $this->metaTitle);
            } else {
                $this->metaTitle .= $val . ' / ';
            }
        }
        // $this->metaTitle = $metaTitle;
        return \ucwords($this->metaTitle);
    }

    public function setDisplayTitle(string $displayTitle = ''): string
    {
        $this->displayTitle = $displayTitle;
        return $this->displayTitle;
    }

    public function getDisplayTitle()
    {
        return $this->displayTitle;
    }

    public function subDisplayTitle()
    {
        return $this->subDisplayTitle;
    }

    protected function getData()
    {
        return $this->render->setData([
            'metaTitle' => $this->metaTitle(),
            'displayTitle' => $this->getDisplayTitle(),
            'subDisplayTitle' => $this->subDisplayTitle(),
            'navbarMenu' => \Codenom\Framework\Libraries\Menu\Item::sort($this->menuLoaded()->primaryNavbar()),
            'adminMenu' => \Codenom\Framework\Libraries\Menu\Item::sort($this->menuLoaded()->adminMenu()),
            'breadcrumb' => $this->addToBreadCrumb()->getBreadcrumb(),
        ]);
    }
}
