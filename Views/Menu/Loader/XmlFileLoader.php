<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Menu\Loader;

use Codenom\Framework\Config\Util\XmlUtils;
use Codenom\Framework\Views\Menu\Element;

class XmlFileLoader
{
    /**
     * Load file XML
     * 
     * @param string $file
     */
    public function load(string $file)
    {
        $path = $file;
        $xml = $this->loadFile($path);
        // $content = [];
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
    protected function parseNode(\DOMElement $node, string $path)
    {
        $content = [];
        if (Element::NAMESPACE_URI !== $node->namespaceURI) {
            return;
        }

        switch ($node->localName) {
            case Element::SWITCH_CHILDREN:
                $content = ['_method' => Element::METHOD_CHILDREN, '_parent' => null, 'content' => $this->parseChildren($node, $path)];
                break;
            case Element::SWITCH_ADD:
                $content = $this->parseAdd($node, $path);
                break;
            case Element::SWITCH_UPDATE:
                $content = $this->parseUpdate($node, $path);
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unknown tag "%s" used in file "%s". Expected "children", "add", "update" or "remove".', $node->localName, $path));
        }

        return $content;
    }

    /**
     * Parse Children
     * 
     * @param \DOMElement $node
     * @param string $path
     * @return array
     */
    private function parseChildren(\DOMElement $node, string $path)
    {
        $content = [];
        if ('' === $parent = $node->getAttribute('name')) {
            throw new \InvalidArgumentException(sprintf('The <name> element in file "%s" must have an "name" attribute.', $node->localName, $path));
        }
        $content['name'] = $parent;

        if ('' === $label = $node->getAttribute('label')) {
            $label = $parent;
        }
        $content['label'] = $label;
        if ('' === $uri = $node->getAttribute('uri')) {
            $uri = '#';
        }
        $content['uri'] = $uri;
        if ('' === $sortOrder = $node->getAttribute('sortOrder')) {
            $sortOrder = 0;
        }
        $content['order'] = (int) $sortOrder;
        if ('' === $icon = $node->getAttribute('icon')) {
            $icon = null;
        }
        $content['icon'] = $icon;
        foreach ($node->getElementsByTagNameNS(Element::NAMESPACE_URI, '*') as $n) {
            if ($node !== $n->parentNode) {
                continue;
            }
            switch ($n->localName) {
                case 'add':
                    $content['children'][] = $this->parseAdd($n, $path);
                    break;
                case 'attribute':
                    $content['attributes'][$n->getAttribute('key')] = $this->parseAttribute($n, $path);
                    break;
                default:
                    throw new \InvalidArgumentException(sprintf('Unknown tag "%s" used in file "%s". Expected "add", "attribute".', $node->localName, $path));
            }
        }
        return $content;
    }

    /**
     * Parse Add
     * Function for add menu
     * 
     * @param \DOMElement $node
     * @param string $path
     * @return array
     */
    private function parseAdd(\DOMElement $node, string $path)
    {
        $content = [];

        if ('' === $parent = $node->getAttribute('parent')) {
            $parent = $parent;
        }

        //set name of name menu
        if ('' === $name = $node->getAttribute('name')) {
            throw new \InvalidArgumentException(sprintf('The <name> element in file "%s" must have an "name" attribute.', $path));
        }

        //set label
        if ('' === $label = $node->getAttribute('label')) {
            $label = $name;
        }

        //add method array
        $content['_method'] = Element::METHOD_ADD;
        $content['_parent'] = (string) $parent ?? null;
        $content['name'] = $name;
        $content['label'] = $label;
        //set uri of uri menu
        $content['uri'] = $node->getAttribute('uri') ?? '#';
        $content['order'] = (int) $node->getAttribute('sortOrder') ?? 0;
        $content['icon'] = (string) $node->getAttribute('icon') ?? null;
        foreach ($node->getElementsByTagNameNS(Element::NAMESPACE_URI, '*') as $n) {
            switch ($n->localName) {
                case 'attribute':
                    $content['attributes'][$n->getAttribute('key')] = $this->parseAttribute($n, $path);
                    break;
                default:
                    throw new \InvalidArgumentException(sprintf('The <name> element in file "%s" must have an "name" attribute.', $path));
                    break;
            }
        }
        return $content;
    }

    /**
     * Parse Update
     * Function for update menu
     * 
     * @param \DOMElement $node
     * @param string $path
     * @return array
     */
    private function parseUpdate(\DOMElement $node, string $path)
    {
        $content = [];
        if ('' === $id = $node->getAttribute('id')) {
            throw new \InvalidArgumentException(sprintf('The <id> element in file "%s" must have an "id" attribute.', $path));
        }
        if ('' === $name = $node->getAttribute('name')) {
            $name = null;
        }
        if ('' === $label = $node->getAttribute('label')) {
            $label = $name;
        }
        //set method
        $content['_method'] = Element::METHOD_UPDATE;
        $content['_parent'] = $id;
        $content['name'] = $name;
        $content['label'] = $label;
        $content['icon'] = (string) $node->getAttribute('icon') ?? null;
        $content['uri'] = $node->getAttribute('uri') ?? null;
        $content['order'] = (int) $node->getAttribute('sortOrder') ?? 0;
        foreach ($node->getElementsByTagNameNS(Element::NAMESPACE_URI, '*') as $n) {
            switch ($n->localName) {
                case 'attribute':
                    $content['attributes'][$n->getAttribute('key')] = $this->parseAttribute($n, $path);
                    break;
                default:
                    throw new \InvalidArgumentException(sprintf('The <name> element in file "%s" must have an "name" attribute.', $path));
                    break;
            }
        }
        return $content;
    }

    /**
     * Parse Attribute
     * Function for attribute menu
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
