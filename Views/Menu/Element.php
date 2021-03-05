<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Menu;

/**
 * XML Menu reader
 */
class Element
{
    /**
     * Switch Type
     * Default
     * @return string
     */
    const SWITCH_CHILDREN = 'children';
    const SWITCH_ADD = 'add';
    const SWITCH_UPDATE = 'update';

    /**
     * Method Type
     * Default
     * 
     * @return string
     */
    const METHOD_UPDATE = '_update';
    const METHOD_ADD = '_add';
    const METHOD_CHILDREN = 'children';

    /**
     * Default Namespace Uri
     * @var const NAMESPACE_URI
     */
    const NAMESPACE_URI = 'http://codenom.com/schema/menu';

    /**
     * Default Scheme Path;
     * @var const SCHEME_PATH
     */
    const SCHEME_PATH = '/schema/menu/menu-1.0.xsd';
}
