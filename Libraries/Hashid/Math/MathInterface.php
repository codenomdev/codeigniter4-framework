<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Hashid\Math;

interface MathInterface
{
    /**
     * Add two arbitrary-length integers.
     *
     * @param string $a
     * @param string $b
     *
     * @return string
     */
    public function add($a, $b);

    /**
     * Multiply two arbitrary-length integers.
     *
     * @param string $a
     * @param string $b
     *
     * @return string
     */
    public function multiply($a, $b);

    /**
     * Divide two arbitrary-length integers.
     *
     * @param string $a
     * @param string $b
     *
     * @return string
     */
    public function divide($a, $b);

    /**
     * Compute arbitrary-length integer modulo.
     *
     * @param string $n
     * @param string $d
     *
     * @return string
     */
    public function mod($n, $d);

    /**
     * Compares two arbitrary-length integers.
     *
     * @param string $a
     * @param string $b
     *
     * @return bool
     */
    public function greaterThan($a, $b);

    /**
     * Converts arbitrary-length integer to PHP integer.
     *
     * @param string $a
     *
     * @return int
     */
    public function intval($a);

    /**
     * Converts arbitrary-length integer to PHP string.
     *
     * @param string $a
     *
     * @return string
     */
    public function strval($a);

    /**
     * Converts PHP integer to arbitrary-length integer.
     *
     * @param int $a
     *
     * @return string
     */
    public function get($a);
}