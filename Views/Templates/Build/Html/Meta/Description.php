<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html\Meta;

use Codenom\Framework\Views\Templates\Build\Html\Element;

class Description extends MetaFactory
{
    private $textValue = null;
    /**
     * Constructor
     *
     * @param       string      $content        meta content
     */
    public function __construct(string $content = null)
    {
        parent::setName(Element::TAG_DESCRIPTION);
        $this->textValue = $content;
    }

    public function set(string $content = null)
    {
        if (!$this->textValue) {
            $this->textValue = $content;
        }

        return parent::setContent($this->textValue);
    }
}
