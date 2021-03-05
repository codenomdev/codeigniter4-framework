<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Routing\Loader;

use Codenom\Framework\Config\Util\XmlUtils;

class XmlFileLoader
{
    // use RouteCollection;
    /**
     * Default Namespace Uri
     * @var const NAMESPACE_URI
     */
    public const NAMESPACE_URI = 'http://symfony.com/schema/routing';

    /**
     * Default Scheme Path;
     * @var const SCHEME_PATH
     */
    public const SCHEME_PATH = '/schema/routing/routing-1.0.xsd';

    /**
     * Loads an XML file.
     *
     * @param string      $file An XML file path
     * @param string|null $type The resource type
     *
     * @return RouteCollection A RouteCollection instance
     *
     * @throws \InvalidArgumentException when the file cannot be loaded or when the XML cannot be
     *                                   parsed because it does not validate against the scheme
     */
    public function load(string $file, string $type = null)
    {
        $path = APPPATH . 'Code\\Codenom\\Dashboard\\Admin\\Config\\routes.xml';
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
     * Parses a node from a loaded XML file.
     *
     * @param \DOMElement $node Element to parse
     * @param string      $path Full path of the XML file being processed
     * @param string      $file Loaded file name
     *
     * @throws \InvalidArgumentException When the XML is invalid
     */
    protected function parseNode(\DOMElement $node, string $path, string $file)
    {
        if (self::NAMESPACE_URI !== $node->namespaceURI) {
            return;
        }

        switch ($node->localName) {
            case 'router':
                return $this->parseRouter($node, $path);
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unknown tag "%s" used in file "%s". Expected "route" or "import".', $node->localName, $path));
        }
        // return $this->parseRoute($node, $path);
    }

    protected function parseRouter(\DOMElement $node, string $path)
    {
        $content = [];
        if (self::NAMESPACE_URI !== $node->namespaceURI) {
            return;
        }
        switch ($node->getAttribute('id')) {
            case 'backend':
                $content = ['_id' => 'backend', '_content' => $this->parseRouteBackend($node, $path)];
                break;
            case 'frontend':
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unknown attribute ID "%s" used in file "%s". Expected "backend" or "frontend".', $node->localName, $path));
        }
        return $content;
    }

    protected function parseRouteBackend(\DOMElement $node, string $path)
    {
        $content = [];
        foreach ($node->getElementsByTagNameNS(self::NAMESPACE_URI, '*') as $n) {
            if ($node !== $n->parentNode) {
                continue;
            }
            switch ($n->localName) {
                case 'add':
                    $content[] = ['type' => '_add', '_remap' => [$this->parseAdd($n, $path)]];
                    break;
                case 'get':
                    $content[] = ['type' => '_get', '_remap' => [$this->parseGet($n, $path)]];
                    break;
                case 'post':
                    $content[] = ['type' => '_post', '_remap' => [$this->parsePost($n, $path)]];
                    break;
                case 'group':
                    $content[] = ['type' => '_group', '_content' => $this->parseGroup($n, $path)];
                    break;
                default:
                    throw new \InvalidArgumentException(sprintf('Unknown attribute "%s" used in file "%s". Expected "add", "post", or "group".', $node->localName, $path));
            }
        }
        return $content;
    }

    private function parseGroup(\DOMElement $node, string $path)
    {
        $content = [];
        foreach ($node->getElementsByTagNameNS(SELF::NAMESPACE_URI, '*') as $n) {
            // switch ($n->localName) {
            //     case 'add':
            //         $content = $this->parseAdd($n, $path);
            //         break;
            //     case 'get':
            //         $content = ['type' => '_get', '_remap' => [$this->parseGet($n, $path)]];
            //         break;
            //     case 'post':
            //         $content = ['type' => '_post', '_remap' => [$this->parsePost($n, $path)]];
            //         break;
            //     case 'group':
            //         // $content = ['type' => '_group', '_content' => $this->parseGroup($n, $path)];
            //         break;
            //     default:
            //         break;
            // }
            $content[] = $n->localName;
        }
        return $content;
    }

    private function parseGet(\DOMElement $node, string $path)
    {
        $content = [];
        [$id, $controller, $module, $options] = $this->parseConfig($node, $path);
        $content['_id'] = $id;
        $content['_controller'] = $controller;
        $content['_module'] = $module;
        $content['_options'] = [$options];
        return $content;
    }

    private function parsePost(\DOMElement $node, string $path)
    {
        $content = [];
        [$id, $controller, $module, $options] = $this->parseConfig($node, $path);
        $content['_id'] = $id;
        $content['_controller'] = $controller;
        $content['_module'] = $module;
        $content['_options'] = [$options];
        return $content;
    }

    private function parseAdd(\DOMElement $node, string $path)
    {
        $content = [];
        [$id, $controller, $module, $options] = $this->parseConfig($node, $path);
        $content['_id'] = $id;
        $content['_controller'] = $controller;
        $content['_module'] = $module;
        $content['_options'] = [$options];
        return $content;
    }

    private function parseConfig(\DOMElement $node, string $path)
    {
        $id = [];
        $controller = [];
        $module = [];
        $options = [];

        if ('' === $id = $node->getAttribute('id')) {
            throw new \InvalidArgumentException(sprintf('The <add> element in file "%s" must have a "id" attribute or <id> child nodes.', $path));
        }

        if ('' === $controller = $node->getAttribute('controller')) {
            throw new \InvalidArgumentException(sprintf('The <add> element in file "%s" must have a "controller" attribute or <controller> child nodes.', $path));
        }

        if ('' === $module = $node->getAttribute('module')) {
            throw new \InvalidArgumentException(sprintf('The <add> element in file "%s" must have a "module" attribute or <module> child nodes.', $path));
        }

        foreach ($node->getElementsByTagNameNS(SELF::NAMESPACE_URI, '*') as $n) {
            switch ($n->localName) {
                case 'option':
                    $options[$n->getAttribute('key')] = $this->parseOption($n, $path);
                    break;
                default:
                    throw new \InvalidArgumentException(sprintf('The <name> element in file "%s" must have an "name" attribute.', $path));
                    break;
            }
        }

        $id = $id;
        $controller = $controller;
        $module = $module;

        return [$id, $controller, $module, $options];
    }

    /**
     * Parse Attribute
     * Function for attribute menu
     * 
     * @param \DOMElement $element
     * @param string $path
     * @return array
     */
    private function parseOption(\DOMElement $element, string $path)
    {
        if ($this->isElementValueNull($element)) {
            return null;
        }
        foreach ($element->childNodes as $child) {
            if (!$child instanceof \DOMElement) {
                continue;
            }

            if (SELF::NAMESPACE_URI !== $child->namespaceURI) {
                continue;
            }
        }
        return trim($element->textContent);
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
        return XmlUtils::loadFile($file, __DIR__ . static::SCHEME_PATH);
    }

    private function isElementValueNull(\DOMElement $element): bool
    {
        $namespaceUri = 'http://www.w3.org/2001/XMLSchema-instance';

        if (!$element->hasAttributeNS($namespaceUri, 'nil')) {
            return false;
        }

        return 'true' === $element->getAttributeNS($namespaceUri, 'nil') || '1' === $element->getAttributeNS($namespaceUri, 'nil');
    }
}
