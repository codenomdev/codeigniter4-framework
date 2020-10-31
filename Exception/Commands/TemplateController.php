<?php

namespace Codenom\Framework\Exception\Commands;

use Codenom\Framework\Exception\Commands\CommentFile;

class TemplateController
{
    public static function setTemplate(string $setModule = null, $namespace, $class)
    {
        $template = "<?php \r\n" . CommentFile::addCommnetOnFilePhp() . "\r\n \r\nnamespace " . $namespace . "\Controllers; \r\n \r\n" . SELF::addUseTemplate($setModule) . "\r\n \r\n" . SELF::addClassTemplate($setModule, $class);

        return $template;
    }

    public static function addClassTemplate(string $setModule = 'frontend', $class)
    {
        $template = '
class ' . $class . ' extends ' . \ucfirst($setModule) . 'Controller
{
        public function index()
        {
            
        }
}
    ';

        return $template;
    }

    public static function addUseTemplate(string $setModule = null)
    {
        $setModule = \ucfirst($setModule);
        switch ($setModule) {
            case 'Frontend':
                return 'use Codenom\Framework\Controllers\Frontend\FrontendController;';
                break;
            case 'Backend':
                return 'use Codenom\Framework\Controllers\Backend\BackendController;';
                break;
            default:
                return 'use Codenom\Framework\Controllers\Frontend\FrontendController;';
                break;
        }
        // return 'use Codenom\Framework\Controllers\Backend\BackendController;';
    }
}
