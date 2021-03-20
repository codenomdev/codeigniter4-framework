<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Views\Templates\Factory;

class Asset
{
    protected $webRoot = "";

    public function __construct($webRoot)
    {
        $this->webRoot = $webRoot;
    }

    public function getWebRoot()
    {
        return $this->webRoot;
    }

    public function getJsPath()
    {
        return $this->getWebRoot() . "/assets/js";
    }

    public function getCssPath()
    {
        return $this->getWebRoot() . "/assets/css";
    }

    public function getImgPath()
    {
        return $this->getWebRoot() . "/assets/img";
    }

    public function getFontsPath()
    {
        return $this->getWebRoot() . "/assets/fonts";
    }

    public function getFilesystemImgPath()
    {
        return \PUBLICPATH . "/assets/img";
    }

    public function cssInclude($filename)
    {
        return sprintf("<link rel=\"stylesheet\" type=\"text/css\" href=\"%s\" />", \base_url($this->getCssPath()) . "/" . $filename);
    }

    public function jsInclude($filename)
    {
        return sprintf("<script type=\"text/javascript\" src=\"%s\"></script>", \base_url($this->getJsPath()) . "/" . $filename);
    }

    public function imgTag($filename, $alt = "", $options = array())
    {
        $attributes = "";
        foreach ($options as $key => $value) {
            $attributes .= " " . $key . "=\"" . $value . "\"";
        }
        return sprintf("<img src=\"%s\" border=\"0\" alt=\"%s\"%s>", \base_url($this->getImgPath()) . "/" . $filename, $alt, $attributes);
    }

    public function icon($rootClassName)
    {
        $iconClassParts = explode("-", $rootClassName, 2);
        return "<i class=\"" . $iconClassParts[0] . " " . $rootClassName . "\"></i>";
    }
}
