<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Math;

interface PriceCurrencyInterface
{
    /**
     * Default precision
     */
    const DEFAULT_PRECISION = 2;

    /**
     * Convert price value
     *
     * @param float $amount
     * @param null|string|bool|int|
     * @param $currency
     * @return float
     */
    public function convert($amount, $scope = null, $currency = null);

    /**
     * Convert and round price value
     *
     * @param float $amount
     * @param null|string|bool|int $scope
     * @param string|null $currency
     * @param int $precision
     * @return float
     */
    public function convertAndRound($amount, $scope = null, $currency = null, $precision = self::DEFAULT_PRECISION);

    /**
     * Format price value
     *
     * @param float $amount
     * @param bool $includeContainer
     * @param int $precision
     * @param null|string|bool|int $scope
     * @param $currency
     * @return float
     */
    public function format(
        $amount,
        $includeContainer = true,
        $precision = self::DEFAULT_PRECISION,
        $scope = null,
        $currency = null
    );

    /**
     * Convert and format price value
     *
     * @param float $amount
     * @param bool $includeContainer
     * @param int $precision
     * @param null|string|bool|int $scope
     * @param  string|null $currency
     * @return string
     */
    public function convertAndFormat(
        $amount,
        $includeContainer = true,
        $precision = self::DEFAULT_PRECISION,
        $scope = null,
        $currency = null
    );

    /**
     * Round price
     *
     * @deprecated 102.0.1
     * @param float $price
     * @return float
     */
    public function round($price);

    /**
     * Get currency model
     *
     * @param null|string|bool|int $scope
     * @param string|null $currency
     * @return mixed
     */
    public function getCurrency($scope = null, $currency = null);

    /**
     * Get currency symbol
     *
     * @param null|string|bool|int  $scope
     * @param  string|null $currency
     * @return string
     */
    public function getCurrencySymbol($scope = null, $currency = null);
}
