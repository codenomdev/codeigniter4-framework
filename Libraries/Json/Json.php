<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Json;

use Laminas\Json\Json as LaminasJson;

class Json
{
    /**
     * Encode the mixed $valueToEncode into the JSON format
     *
     * Encodes using ext/json's json_encode() if available.
     *
     * NOTE: Object should not contain cycles; the JSON format
     * does not allow object reference.
     *
     * NOTE: Only public variables will be encoded
     *
     * NOTE: Encoding native javascript expressions are possible using Laminas\Json\Expr.
     *       You can enable this by setting $options['enableJsonExprFinder'] = true
     *
     * @see Laminas\Json\Expr
     *
     * @param  mixed $valueToEncode
     * @param  bool $cycleCheck Optional; whether or not to check for object recursion; off by default
     * @param  array $options Additional options used during encoding
     * @return string JSON encoded object
     */
    public static function encode($valueToEncode, $cycleCheck = Element::CYCLE_CHECK, array $option = [])
    {
        return LaminasJson::encode($valueToEncode, $cycleCheck);
    }

    /**
     * Decode data to Object return.
     *
     * @var \Laminas\Json\Json
     *
     * @param array
     *
     * @return object
     */
    public static function decodeToObject($param)
    {
        return LaminasJson::decode($param, Element::TYPE_OBJECT);
    }

    /**
     * Decode data to Array return.
     *
     * @var \Laminas\Json\Json
     *
     * @param array
     *
     * @return array
     */
    public static function decodeToArray($param)
    {
        return LaminasJson::decode($param, Element::TYPE_ARRAY);
    }
}
