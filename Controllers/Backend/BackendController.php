<?php

namespace Codenom\Framework\Controllers\Backend;

class BackendController extends \CodeIgniter\Controller
{
    /**
     * Load Codenom/Components/Config/Templates.php
     * 
     * @return mixed
     */
    protected $config;

    /**
     * Load Codenom/Framework/Config/Services.php
     * @var Services::view()
     * @return mixed
     */
    protected $render;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

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
        // $this->session = \Config\Services::session();
        $this->config = config('Codenom\Components\Config\Templates');
        \var_dump($this->config);
        die;
        $this->render = \Codenom\Framework\Config\Services::View('awdaw');
    }
}
