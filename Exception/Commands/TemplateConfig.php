<?php

namespace Codenom\Framework\Exception\Commands;

use Codenom\Framework\Exception\Commands\CommentFile;

class TemplateConfig
{
    public static function setTemplate(string $setModule = null, $namespace)
    {
        $template = "<?php" . CommentFile::addCommnetOnFilePhp() . "\r\n \r\n" . SELF::addRoutes($setModule, $namespace);
        return $template;
    }

    public static function addRoutes(string $setModule = null, $namespace)
    {
        $setModule = \strtolower($setModule);
        $template = "
if(!isset(\$routes))
{ 
    \$routes = \Config\Services::routes(true);
}
\r\n
\$routes->group('$setModule', ['namespace' => '$namespace'], function(\$subroutes){
    \$subroutes->get('dashboard', 'Dashboard::index');
});
        ";

        return $template;
    }
}
