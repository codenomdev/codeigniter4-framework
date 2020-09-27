<?php

namespace Codenom\Framework\Controllers\Api;

class ApiController extends \CodeIgniter\RESTful\ResourceController
{

    /**
     * protected or private property $modelName
     * default = null
     * 
     * @var string or namespace Model
     * 
     */
    protected $modelName = '';

    /**
     * protected or private property $format
     * @var output type data
     * 
     * default = json
     * 
     */
    protected $format = 'json';

    public function execute($data, $statusCode = 200)
    {
        return $this->respond($data);
    }
}
