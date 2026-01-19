<?php
    require_once(ROOT_PATH . '/middleware/user_middleware.php');
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

            $uri = urldecode($uri);

            foreach($this->routes[$method] as $route => $handler){
                $route_list = explode("/", trim($route, "/"));
                $uri_list = explode("/", trim($uri, "/"));

                $match = [];
                $matched = true;


                if (count($uri_list) !== count($route_list)){
                    continue;
                }


                for ($i = 0; $i < count($route_list); $i++){
                    if ($uri_list[$i] === $route_list[$i]) {
                        continue;
                    } elseif ((substr($route_list[$i], 0, 1) == "{") && (str_ends_with($route_list[$i], "}"))){
                        $match[] = $uri_list[$i];
                        continue;
                    }

                    $matched = false;
                    break;
                }
                
                if ($matched){
                    [$controller, $action] = $handler;
                    break;
                }

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
            if (isset($match)){
                $result = ($controllerInstance) -> $action(...$match);
            } else { 
                $result = ($controllerInstance) -> $action();
            }
            $path = $result['path'];
            $type = $path[0];
            $path_type = $path[1];

            ob_start();
            if ($result['data'] != null){
                if (isset($result['data']['comments'])){
                    $comments = $result['data']['comments'];
                }
                if (isset($result['data']['posts'])){
                    $posts = $result['data']['posts'];
                } 
                if (isset($result['data']['post_id'])){
                    $post_id = $result['data']['post_id'];
                }
                if (isset($result['data']['stats'])){
                    $stats = $result['data']['stats'];
                }
            } //refactor it later

            // var_dump($posts);
            if (isset($path_type)){
            require __DIR__ . "/../views/$path_type.php";
            }
            $content = ob_get_clean(); //remove it and then add it to controllers
            if ($type == 'user') {
                RequireUser($this->services['SessionService']);
                require __DIR__ . '/../views/layouts/main.php';
            } elseif (($type == 'admin')) {
                RequireAdmin($this->services['SessionService']);
                require __DIR__ . '/../views/admin/layouts/main.php';
            } else {
                require __DIR__ . '/../views/layouts/main.php';
            }
            exit;
        }
    }
?>