<?php
declare(strict_types=1);

namespace Src\app\routing;

class Router
{
    //Predefined routes
    private $routes=[];
    public function __construct() {
        $this->add('', 'Listing', 'index');
        $this->add('list', 'Listing', 'list');
        $this->add('pagination', 'Listing', 'pagination');
        $this->add('projects', 'Listing', 'projects');
        $this->add('users', 'Listing', 'users');
        $this->add('create', 'Operations', 'create');
        $this->add('update', 'Operations', 'update');
        $this->add('details', 'Operations', 'details');
    }

    private function add($route, $controller, $action) {
        $this->routes[$route] = array('controller'=>$controller, 'action'=>$action);
    }

    //Return all the predefined routes
    public function routes(): array {
        return $this->routes;
    }
}