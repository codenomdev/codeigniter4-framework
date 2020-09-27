<?php

namespace Codenom\Framework\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use Codenom\Framework\Libraries\Oauth;
use \OAuth\Request;
use \OAuth\Response;

class ApiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $oauth = new Oauth();
        $request = Request::createFromGlobals();
        $response = new Response();

        if (!$oauth->server->verifyResourceRequest($request)) {
            $oauth->server->getResponse()->send();
            die();
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
