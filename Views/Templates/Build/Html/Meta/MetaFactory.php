<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Build\Html\Meta;

use Codenom\Framework\Views\Templates\Build\Layout\LayoutAbstract;
use Codenom\Framework\Views\Templates\Build\Html\Element;
use Naucon\HtmlBuilder\Exception\HtmlElementException;

class MetaFactory extends LayoutAbstract
{
    protected $tag = Element::TAG_META;
    private $textValue;

    /**
     * @return      string                  html element attribute name
     */
    public function getName()
    {
        return $this->getAttribute('name');
    }

    /**
     * @param       string      $name       html element attribute name
     * @return      HtmlMetaAbstract
     */
    public function setName($name)
    {
        $this->setAttribute('name', $name);
        return $this;
    }

    /**
     * @return      string                  html element attribute content
     */
    public function getContent()
    {
        return $this->getAttribute('content');
    }

    /**
     * @param       string      $content    html element attribute content
     * @return      HtmlMetaAbstract
     */
    public function setContent($content)
    {
        $this->setAttribute('content', $content);
        return $this;
    }

    /**
     * add html element content
     *
     * @param       string      $content    html element content
     * @throws      HtmlElementException
     */
    public function addContent($content = null)
    {
        throw new HtmlElementException('meta content can not be added', E_NOTICE);
    }
}
