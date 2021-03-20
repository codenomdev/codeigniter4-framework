<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\Config\Dynamic;

use Codenom\Framework\Data\ObjectManager\ObjectManager;
use Codenom\Framework\Config\TableRepository;
use Codenom\Framework\Config\ScopeConfigInterface;
use Codenom\Framework\Config\Scope\Converter;

class DefaultScope
{
    /**
     * @var Codenom\Framework\Config\Scope\Converter
     */
    protected $converter;

    /**
     * @var Codenom\Framework\Data\ObjectManager\ObjectManager
     */
    protected $objectManager;

    public function __construct()
    {
        $this->converter = new Converter();
        $this->objectManager = new ObjectManager(TableRepository::TABLE_CONFIG);
    }

    /**
     * Retrieve config by default scope
     *
     * @param string|null $scopeCode
     * @return array
     */
    public function get($scopeCode = null)
    {
        try {
            if (!$collection = cache($scopeCode . '_defaultScope')) {
                $collection = $this->objectManager->where(['scope' => ScopeConfigInterface::SCOPE_TYPE_DEFAULT])->load()->getResult();
                cache()->save($scopeCode . '_defaultScope', $collection, 3600);
            }
        } catch (\DomainException $e) {
            $collection = [];
        }
        $config = [];
        foreach ($collection as $item) {
            $config[$item->path] = $item->value;
        }

        // return $config;
        return $this->converter->convert($config);
    }
}
