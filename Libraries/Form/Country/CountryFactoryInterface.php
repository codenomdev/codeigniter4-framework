<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Form\Country;

/**
 * Country Factory Interface
 * 
 * @author Ilham Falachul Adha
 * @link http://codenom.com
 * @version 1.0
 * @package Codenom/Framework
 */
interface CountryFactoryInterface
{
    public function __construct();
    /**
     * Get country id for rules form in_list
     * 
     * @return string
     */
    public function getCountryInList(): string;
}
