<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

/**
 * Load helper core form
 */
helper('form');

/**
 * Clickable
 */
if (!function_exists('clickable_input')) {

    /**
     * Clickable Input
     * 
     * @param string $name of input name
     * @param string $value
     * @param string|int $default
     * 
     * @return string
     */
    function clickable_input($name, string $value = '', string $default = '')
    {
        // $checkbox = '';
        $checkbox = '<div class="custom-control custom-checkbox d-inline-block">';
        $checkbox .= form_checkbox($name, $value, $default, ['class' => 'custom-control-input', 'id' => 'row_' . $value]);
        $checkbox .= form_label('', 'row_' . $value, ['class' => 'custom-control-label']);
        $checkbox .= '</div>';
        return $checkbox;
    }
}

/**
 * Add class
 */
if (!function_exists('add_class')) {

    /**
     * Add Class
     * 
     * @param string $openClass type: div, p, or etc...
     * @param string $className
     * @param string $text
     */
    function add_class(string $openClass = 'div', string $className = '', string $text = '')
    {
        $html = '';
        $className = $className ? 'class="' . $className . '"' : '';
        $html .= "<{$openClass} {$className}>";
        $html .= $text;
        $html .= "</{$openClass}>";
        return $html;
    }
}
