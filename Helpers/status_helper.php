<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

if (!function_exists('status_handler')) {
    function status_handler($status)
    {
        if ($status == '1' || $status == 1) {
            return 'Enable';
        } elseif ($status == '0' || $status == 0) {
            return 'Disable';
        }
    }
};
if (!function_exists('get_status')) {
    function get_status()
    {
        return [
            '0' => 'Disable',
            '1' => 'Enable'
        ];
    }
}
