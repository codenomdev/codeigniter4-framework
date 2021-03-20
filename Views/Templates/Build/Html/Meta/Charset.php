<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html\Meta;

use Codenom\Framework\Views\Templates\Build\Html\Element;

class Charset extends MetaFactory
{
    public function set(string $charset = null)
    {
        if (!$charset) {
            $this->textValue = $this->getDefaultCharset();
        }

        $this->textValue = $charset;
        return $this->setCharset($this->textValue);
    }

    public function getDefaultCharset()
    {
        $this->textValue = Element::DEFAULT_CHARSET;
        return $this->textValue;
    }

    private function setCharset($content)
    {
        return parent::setAttribute(Element::TAG_CHARSET, $content);
    }
}
