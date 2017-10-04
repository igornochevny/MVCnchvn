<?php

namespace app;

use app\http\Controller;

class QueryHandler
{
    private static $handler;

    private $controllerNamespace = 'app\http';

    public static function getInstance(): QueryHandler
    {
        if (null === static::$handler) {
            static::$handler = new static();
        }

        return static::$handler;
    }

    public function routes() {
        return [
          'post/all' => 'PostController@all'
        ];
    }

    public function handle($requestURI): Controller
    {
        $URIComponents = explode('/', $requestURI);

        $controllerID = $URIComponents[1];

        if(!empty($controllerID) && is_string($controllerID)) {
            $actionID = (!empty($URIComponents[2]) && is_string($URIComponents[2])) ? $URIComponents[2] : 'index';

            $routes = $this->routes();

            if (array_key_exists("$controllerID/$actionID", $routes)) {
                $route = $routes["$controllerID/$actionID"];

                $uriParams = explode('@', $route);

                $controllerClassName = $uriParams[0];

                $actionName = $uriParams[1];

                $controllerNamespace = $this->controllerNamespace . '\\' . $controllerClassName;

                if (class_exists($controllerNamespace)) {
                    $controllerClass = new $controllerNamespace($actionName);

                    if (method_exists($controllerClass, $actionName)) {
                        return $controllerClass;
                    }

                }
            }
        }
        throw new \Exception('Requested URL was not found', 404);
    }
    /**
     * QueryHandler constructor.
     * http://designpatternsphp.readthedocs.io/ru/latest/Creational/Singleton/README.html
     */
    public function __construct()
    {
        return false;
    }
    /**
     * http://designpatternsphp.readthedocs.io/ru/latest/Creational/Singleton/README.html
     * @return bool
     */
    public function __wakeup()
    {
        return false;
    }
    /**
     * http://designpatternsphp.readthedocs.io/ru/latest/Creational/Singleton/README.html
     * @return bool
     */
    public function __clone()
    {
        return false;
    }
}