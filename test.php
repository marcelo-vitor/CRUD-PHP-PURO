<?php
echo "<pre>";

$routes = [
    [
        "name" => 'index',
        "url" => ''
    ],
    [
        "name" => 'show',
        "url" => 'show/{id}/cachorro/{dog}'
    ],
];

$uri = $_GET['url'] ?? '';

$uri = explode('/', $uri);

$rota = false;


foreach ($routes as $route) {
    $routeUri = explode('/', $route['url']);
    $params = [];

    $error = false;

    if (count($routeUri) == count($uri)) {
        foreach ($routeUri as $key => $router) {
            if (strpos($router, '}')) {
                $param = explode('}', explode('{', $router)[1])[0];
                $params[$param] = $uri[$key];
            } else if ($router != $uri[$key]) {
                $error = true;
                break;
            }
        }
    } else {
        $error = true;
    }

    if (!$error) {
        $rota = $route;
        break;
    }
}

var_dump($rota);


echo "</pre>";
