<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html\Meta;

use Codenom\Framework\Views\Templates\Build\Html\Element;

/**
 * Html Meta Keywords Class
 */
class Keywords extends MetaFactory
{
    private $textValue;
    /**
     * Constructor
     *
     * @param       string|array      $content        meta content
     */
    public function __construct()
    {
        parent::setName(Element::TAG_KEYWORDS);
    }

    /**
     * @param       mixed       $content        html element attribute content
     * @return      HtmlMetaKeywords
     */
    public function setContent($content)
    {
        if (is_array($content)) {
            $this->textValue = implode(', ', $content);
        } else {
            $this->textValue = $content;
        }
        // parent::setAttribute(Element::TAG_CONTENT, $metaContent);
        return parent::setContent($this->textValue);
    }
}
