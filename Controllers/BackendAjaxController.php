<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BackendAjaxController extends Controller
{

    /**
     * @var CodeIgniter\HTTP\RequestInterface
     */
    protected $request;

    /**
     * @var CodeIgniter\HTTP\ResponseInterface
     */
    protected $response;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->request = $request;
        $this->response = $response;

        if (!$this->request->isAJAX()) {
            throw new \Exception('Only Ajax request', 500);
        }
    }
}
