<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Math;

class Calculator
{
    /**
     * Delta collected during rounding steps
     *
     * @var float
     */
    protected $_delta = 0.0;

    /**
     * @var \Codenom\Framework\Libraries\Math\PriceCurrencyInterface|null
     */
    protected $priceCurrency;

    public function __construct(\Codenom\Framework\Libraries\Math\PriceCurrencyInterface $priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * Round price considering delta
     *
     * @param float $price
     * @param bool $negative Indicates if we perform addition (true) or subtraction (false) of rounded value
     * @return float
     */
    public function deltaRound($price, $negative = false)
    {
        $roundedPrice = $price;
        if ($roundedPrice) {
            if ($negative) {
                $this->_delta = -$this->_delta;
            }
            $price += $this->_delta;
            $roundedPrice = $this->priceCurrency->round($price);
            $this->_delta = $price - $roundedPrice;
            if ($negative) {
                $this->_delta = -$this->_delta;
            }
        }
        return $roundedPrice;
    }
}
