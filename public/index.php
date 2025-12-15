<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/feed' => 'FeedController.php',
    '/signin' => 'UserController.php',
    '/signup' => 'UserController.php'
];

if (isset($routes[$uri])) {
    require __DIR__ . '/../app/controllers/' . $routes[$uri];
    exit;
}

http_response_code(404);
echo 'Not found';

?>