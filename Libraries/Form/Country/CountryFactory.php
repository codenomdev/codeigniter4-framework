<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Form\Country;

use Codenom\Framework\Data\Country\CountryManager;
use Codenom\Framework\Libraries\Form\Country\CountryFactoryInterface;

/**
 * Country Factory
 * 
 * @author Ilham Falachul Adha
 * @link http://codenom.com
 * @version 1.0
 * @package Codenom/Framework
 */
class CountryFactory implements CountryFactoryInterface
{

    /**
     * @var Codenom\Framework\Data\Country\CountryManager
     */
    protected $countryManager;

    public function __construct()
    {
        $this->countryManager = new CountryManager();
    }

    /**
     * Get country id for rules form in_list
     * 
     * @return string
     */
    public function getCountryInList(): string
    {
        $countryManager = $this->countryManager->select('id as country_id')->getCollection();
        $data = [];
        foreach ($countryManager as $key => $value) {
            $data[$key] = $value->country_id;
        }

        $list = implode($data, ',');

        return $list;
    }
}
