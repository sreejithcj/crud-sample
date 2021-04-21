<?php
declare(strict_types=1);

namespace Src\app\routing;
use Src\app\routing\Router;

class Dispatcher
{
    private $route = null;
    public function __construct() {
        $this->route = new Router();
    }

    //Dispatch the requests to appropriate controllers
    public function dispatch($segments) {
        $routes = $this->route->routes();
        $dest = end($segments);
        if(!array_key_exists($dest, $routes)) {
            echo('URL does not exist');
            return null;
        }
        $controller = $this->namespace() . $routes[$dest]['controller'];
        $action = $routes[$dest]['action'];
        if (class_exists($controller)) {
            $obj = new $controller();
            if(method_exists($controller,$action)) {
                $obj->$action();
            }         
        }
    }

    //Namespace for the controllers
    private function namespace(): string {
        return 'Src\\controller\\';
    }
}