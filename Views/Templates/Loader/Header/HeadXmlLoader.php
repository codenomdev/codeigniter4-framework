<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Loader\Header;

use Codenom\Framework\Config\Util\XmlUtils;

class HeadXmlLoader
{
    /**
     * Load File
     */
    public function load(string $file)
    {
        $path = \APPPATH . 'Code/Codenom/Dashboard/Admin/Config/head.xml';
        $xml = $this->loadFile($path);
        foreach ($xml->documentElement->childNodes as $node) {
            if (!$node instanceof \DOMElement) {
                continue;
            }
            $content[] = $this->parseNode($node, $path, $file);
        }
        return $content;
    }

    /**
     * Parse Node
     * 
     * @param \DOMElement $node
     * @param string $path
     * @return array
     */
    protected function parseNode(\DOMElement $node, string $path, string $file)
    {
        $content = [];
        if (Element::NAMESPACE_URI !== $node->namespaceURI) {
            return;
        }
        switch ($node->localName) {
            case 'meta':
                $content = $this->parseMeta($node, $path);
                break;
            case 'link':
                break;
            case 'script':
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unknown tag "%s" used in file "%s". Expected "meta", "link", or "script".', $node->localName, $path));
        }
        return $content;
    }

    protected function parseMeta(\DOMElement $node, string $path)
    {
        $content = [];

        if ($nameType = $node->getAttribute('name')) {
            $content['_meta_name'] = $nameType;
        }
        if ($contentType = $node->getAttribute('content')) {
            $contentType = $contentType;
        }
        if ($property = $node->getAttribute('property')) {
            $content['_meta_name'] = $property;
        }
        $content['_meta_content'] = $contentType;
        return $content;
    }

    /**
     * Parse Attribute
     * Function for attribute head
     * 
     * @param \DOMElement $element
     * @param string $path
     * @return array
     */
    private function parseAttribute(\DOMElement $element, string $path)
    {
        if ($this->isElementValueNull($element)) {
            return null;
        }
        foreach ($element->childNodes as $child) {
            if (!$child instanceof \DOMElement) {
                continue;
            }

            if (Element::NAMESPACE_URI !== $child->namespaceURI) {
                continue;
            }
        }
        return trim($element->textContent);
    }

    /**
     * Default value nill or null
     * 
     * @param \DOMElement $element
     * @return bool
     */
    private function isElementValueNull(\DOMElement $element): bool
    {
        $namespaceUri = 'http://www.w3.org/2001/XMLSchema-instance';

        if (!$element->hasAttributeNS($namespaceUri, 'nil')) {
            return false;
        }

        return 'true' === $element->getAttributeNS($namespaceUri, 'nil') || '1' === $element->getAttributeNS($namespaceUri, 'nil');
    }

    /**
     * Loads an XML file.
     *
     * @param string $file An XML file path
     *
     * @return \DOMDocument
     *
     * @throws \InvalidArgumentException When loading of XML file fails because of syntax errors
     *                                   or when the XML structure is not as expected by the scheme -
     *                                   see validate()
     */
    protected function loadFile(string $file)
    {
        return XmlUtils::loadFile($file, __DIR__ . Element::SCHEME_PATH);
    }
}
