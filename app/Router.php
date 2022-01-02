<?php

namespace library;

use library\model\Conf;
use library\utils\Str;

class Router
{

    public static function route(string $uri)
    {
        $conf = new Conf("conf.ini");
        $params = explode('/', substr(strtok($uri, '?'), strlen($conf->URL_DIR)));
        if (empty($params[0])) {
            (new presenter\Catalog($conf, []))->execute();
        } else {
            $classClassName = 'library\presenter\\' . Str::toCamelCase($params[0]);
            try {
                $presenter = new $classClassName($conf, $params);
                if (method_exists($classClassName, 'execute')) {
                    $presenter->execute();
                }
            } catch (\Exception $e) {
                (new presenter\Error($conf, ['error', '404']))->execute();
            }
        }
    }
}
