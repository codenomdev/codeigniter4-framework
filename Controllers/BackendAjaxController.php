<?php

namespace Codenom\Framework\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BackendAjaxController extends Controller
{
    protected $request;
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
