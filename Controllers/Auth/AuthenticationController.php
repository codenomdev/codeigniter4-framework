<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Controllers\Auth;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Codenom\Framework\Config\Auth\AuthManager;
use Psr\Log\LoggerInterface;
use Codenom\Framework\Libraries\Auth\Authentication;

class AuthenticationController extends Controller
{
    /**
     * @var \Codenom\Framework\Config\Auth\AuthManager
     */
    protected $authManager;

    /**
     * @var \Myth\Auth\Config\Auth
     */
    protected $config;

    /**
     * @var \Codenom\Framework\Libraries\Auth\Authentication
     */
    protected $auth;

    /**
     * @var \Config\Services::renderer()
     */
    protected $render;

    /**
     * @var \CodeIgniter\HTTP\RequestInterface
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
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        $this->request = $request;
        $this->response = $response;
        $this->logger = $logger;
        $this->render = \Config\Services::renderer();
        $this->config = config('AuthConfig');
        $this->auth = service('authentication');
        $this->authManager = new AuthManager();

        if ($this->auth->check()) {
            $redirectURL = session('redirect_url') ?? '/';
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL);
        }
        $this->getData();
        //load helper
        helper(['admin', 'html', 'form']);
    }

    private function getData()
    {
        return $this->render->setData([
            'allowRegistration' => $this->authManager->allowRegistration(),
            'config' => $this->config,
        ]);
    }
}
