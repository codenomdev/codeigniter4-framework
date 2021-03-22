<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Controllers\Action;

class Context implements \Codenom\Framework\Context\ContextInterface
{
    /**
     * Helpers that will be automatically loaded on class instantiation.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Instance of the main Request object.
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Instance of the main response object.
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Instance of logger to use.
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Should enforce HTTPS access for all methods in this controller.
     *
     * @var integer Number of seconds to set HSTS header
     */
    protected $forceHTTPS = 0;

    /**
     * Once validation has been run, will hold the Validation instance.
     *
     * @var Validation
     */
    protected $validator;

    // public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    // {
    //     $this->request = $request;
    //     $this->response = $response;
    //     $this->logger = $logger;
    // }

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->response = \Config\Services::response();
    }

    public function getRequestUri()
    {
        return $this->request->uri;
    }
    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
