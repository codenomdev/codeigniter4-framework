<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Config;

class Config
{
    /**#@+
     * Constants of available types
     */
    const ELEMENT_TYPE_BODY = 'body';
    const ELEMENT_TYPE_HTML = 'html';
    const ELEMENT_TYPE_HEAD = 'head';

    /**
     * Allowed group of types
     *
     * @var array
     */
    protected $allowedTypes = [
        self::ELEMENT_TYPE_BODY,
        self::ELEMENT_TYPE_HTML,
        self::ELEMENT_TYPE_HEAD,
    ];

    /**#@-*/
    const META_DESCRIPTION = 'description';
    const META_CONTENT_TYPE = 'content_type';
    const META_MEDIA_TYPE = 'media_type';
    const META_CHARSET = 'charset';
    const META_TITLE = 'title';
    const META_KEYWORDS = 'keywords';
    const META_ROBOTS = 'robots';
    const META_X_UI_COMPATIBLE = 'x_ua_compatible';

    /**
     * Constant html language attribute
     */
    const HTML_ATTRIBUTE_LANG = 'lang';

    /**
     * @var array
     */
    protected $metadata = [
        'charset' => null,
        'media_type' => null,
        'content_type' => null,
        'title' => null,
        'description' => null,
        'keywords' => null,
        'robots' => null,
    ];

    /**
     * @var Title
     */
    protected $title;

    /**
     * @var \Codenom\Framework\Views\Templates\Layout\BuilderInterface
     */
    protected $builder;

    public function __construct()
    {
        $this->title = new Title();
        $this->setElementAttribute(
            self::ELEMENT_TYPE_HTML,
            self::HTML_ATTRIBUTE_LANG,
            strstr('en_En', '_', true)
        );
    }

    /**
     * Build page config from page configurations
     *
     * @return void
     */
    protected function build()
    {
        if (!empty($this->builder)) {
            $this->builder->build();
        }
    }

    /**
     * Set additional element attribute
     *
     * @param string $elementType
     * @param string $attribute
     * @param mixed $value
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function setElementAttribute($elementType, $attribute, $value)
    {
        $this->build();
        if (array_search($elementType, $this->allowedTypes) === false) {
            throw new \Exception('%1 isn\'t allowed', [$elementType]);
        }
        $this->elements[$elementType][$attribute] = $value;
        return $this;
    }

    /**
     * Set metadata.
     *
     * @param string $name
     * @param string $content
     * @return void
     */
    public function setMetadata($name, $content)
    {
        $this->build();
        $this->metadata[$name] = \esc($content);
    }

    /**
     * Returns metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        $this->build();
        return $this->metadata;
    }

    /**
     * Retrieve title element text (encoded)
     *
     * @return Title
     */
    public function getTitle()
    {
        $this->build();
        return $this->title;
    }

    /**
     * Set content type
     *
     * @param string $contentType
     * @return void
     */
    public function setContentType($contentType)
    {
        $this->setMetadata(self::META_CONTENT_TYPE, $contentType);
    }
}
