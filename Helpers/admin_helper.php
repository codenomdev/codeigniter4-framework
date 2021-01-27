<?php

/**
 * Load helper core
 */
helper('form');

/**
 * Lets start create admin helper functions.
 * 
 * @author Ilham Falachul Adha
 * @version 1.0
 * @package Codenom Framework
 * 
 */

if (!function_exists('admin_static')) {
    function admin_static(string $str): string
    {
        return base_url('static/adminhtml/' . $str);
    }
}

if (!function_exists('admin_url')) {
    function admin_url(string $uri): string
    {
        return base_url('backend/' . $uri);
    }
}

if (!function_exists('start_form')) {
    /**
     * Form Declaration
     *
     * Creates the opening portion of the form.
     *
     * @param string       $action     the URI segments of the form destination
     * @param array|string $attributes a key/value pair of attributes, or string representation
     * @param array        $hidden     a key/value pair hidden data
     *
     * @return string
     */
    function start_form(string $action = '', $attributes = [], array $hidden = []): string
    {
        $drawHtml = '';
        $drawHtml .= '<div class="row">';
        $drawHtml .= '<div class="col-lg-7 col-md-7 col-12 mx-auto">';
        $drawHtml .= form_open($action, $attributes, $hidden);
        $drawHtml .= csrf_field();

        return $drawHtml;
    }
}

if (!function_exists('end_form')) {
    /**
     * Form Close Tag
     *
     * @param string $extra
     *
     * @return string
     */
    function end_form(string $extra = ''): string
    {
        $drawHtml = '';
        $drawHtml .= form_close($extra);
        $drawHtml .= '</div>';
        $drawHtml .= '</div>';
        return $drawHtml;
    }
}

/**
 * FORM ADMIN
 */
if (!function_exists('add_field_hidden')) {
    /**
     * Hidden Input Field
     *
     * Generates hidden fields. You can pass a simple key/value string or
     * an associative array with multiple values.
     *
     * @param string|array $name      Field name or associative array to create multiple fields
     * @param string|array $value     Field value
     * @param boolean      $recursing
     *
     * @return string
     */
    function add_field_hidden($name, $value = '', bool $recursing = false): string
    {
        $inputHtml = '';
        $inputHtml .= form_hidden($name, $value, $recursing);
        return $inputHtml;
    }
}
if (!function_exists('add_field_text')) {
    /**
     * Text Input Field. If 'type' is passed in the $type field, it will be
     * used as the input type, for making 'email', 'phone', etc input fields.
     *
     * @param mixed  $data
     * @param string $value
     * @param mixed  $extra
     * @param string $type
     *
     * @return string
     */
    function add_field_text($data = '', string $value = '', $extra = [], string $type = 'text'): string
    {
        $attributes = builderHtml($data, $extra);
        $inputHtml = '';
        $inputHtml .= $attributes['row'];
        $inputHtml .= $attributes['label'];
        $inputHtml .= $attributes['col'];
        $components = ['class' => $attributes['inputClass'], 'id' => $attributes['inputId']];
        $extras = array_merge($components, $extra);
        unset($extras['label']);
        $inputHtml .= form_input($data, $value, $extras, $type);
        $inputHtml .= $attributes['endCol'];
        $inputHtml .= $attributes['endRow'];

        return $inputHtml;
    }
}
if (!function_exists('add_field_dropdown')) {
    /**
     * Drop-down Menu
     *
     * @param mixed $data
     * @param mixed $options
     * @param mixed $selected
     * @param mixed $extra
     *
     * @return string
     */
    function add_field_dropdown($data = '', $options = [], $selected = [], $extra = []): string
    {
        $attributes = builderHtml($data, $extra);
        $inputHtml = '';
        $inputHtml .= $attributes['row'];
        $inputHtml .= $attributes['label'];
        $inputHtml .= $attributes['col'];
        $components = ['class' => $attributes['inputClass'], 'id' => $attributes['inputId']];
        $extras = array_merge($components, $extra);
        unset($extras['label']);
        $inputHtml .= form_dropdown($data, $options, $selected, $extras);
        $inputHtml .= $attributes['endCol'];
        $inputHtml .= $attributes['endRow'];

        return $inputHtml;
    }
}
if (!function_exists('add_field_submit')) {
    function add_field_submit(): string
    {
        $html = '';
        $html = '<div class="d-flex justify-content-end">';
        $extra = ['class' => 'btn btn-primary btn-square', 'type' => 'submit', 'content' => 'Save'];
        $html .= '<div>';
        $html .= form_button($extra);
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
if (!function_exists('builderHtml')) {
    function builderHtml($data, $extra)
    {
        $drawer = [];
        $drawer['row'] = '<div class="form-group row">';
        $defaultCol = 'col-sm-12';
        $drawer['label'] = null;
        $drawer['inputClass'] = 'form-control';
        $attributesId = \ucfirst($data);
        $drawer['placeholder'] = null;
        if (is_array($extra) && array_key_exists('id', $extra)) {
            $attributesId = $extra['id'];
        }
        if (is_array($extra) && array_key_exists('label', $extra)) {
            $defaultCol = 'col-sm-8';
            $drawer['label'] = '<label class="col-sm-4" for="' . $attributesId . '">' . $extra['label'] . '</label>';
        }
        if (is_array($extra) && array_key_exists('class', $extra)) {
            $drawer['inputClass'] = $extra['class'];
        }
        // if (is_array($extra) && array_key_exists('placeholder', $extra)) {
        //     $drawer['placeholder'] = $extra['placeholder'];
        // }
        $drawer['inputId'] = $attributesId;
        $drawer['col'] = '<div class="' . $defaultCol . '">';
        $drawer['endCol'] = '</div>';
        $drawer['endRow'] = '</div>';

        return $drawer;
    }
}
