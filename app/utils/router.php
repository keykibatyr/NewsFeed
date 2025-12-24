<?php
    class Router {
        private array $routes = [];
        private array $services = [];

        public function __construct(array $services){
            $this->services = $services;
        }

        public function get(string $route, array $handler){
            $this -> routes['GET'][$route] = $handler;
        }

        public function post(string $route, array $handler) {
            $this -> routes['POST'][$route] = $handler;
        }

        public function dispatch(string $method, string $uri) {
            [$controller, $action] = $this->routes[$method][$uri];
            if (!isset($this->routes[$method][$uri])){
                http_response_code(404);
                echo 'Not found';
            }

            $ref = new ReflectionClass($controller);
            $constractor= $ref -> getConstructor();
            $params = $constractor -> getParameters();

            $args = [];

            foreach($params as $param){
                $type = $param -> getType();
                if ($type instanceof ReflectionNamedType) {
                    $name = $type->getName();
                }
                $args[] = $this->services[$name];
            }

            $controllerInstance = new $controller(...$args);
            $result = ($controllerInstance) -> $action();
            $path = $result['path'];

            ob_start();
            $data = $result['data'];
            $posts = $data;
            require __DIR__ . "/../views/$path.php";
            $content = ob_get_clean(); //remove it and then add it to controllers
            require __DIR__ . '/../views/layouts/main.php';
            exit;
        }
    }
?>