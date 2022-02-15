<?php

function routerView($get)
{

    $uri = $_GET['url'] ?? '';

    $uri = explode('/', $uri);

    $rota = false;

    foreach (routes() as $route) {
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

    if ($rota) {
        $controller = explode(':', $rota['action'])[0];
        $method = explode(':', $rota['action'])[1];
        call_user_func(array(new $controller, $method), $params);
        return;
    } else {
        echo "Está rota não está definida!";
    }
}

function route($name, $params = [])
{
    $url = '/davos-tech/';

    foreach (routes() as $route) {
        if ($route['name'] == $name) {

            foreach ($params as $key => $value) {
                $param = '{' . $key . '}';
                $route['url'] = str_replace($param, $value, $route['url']);
            }

            return $url . $route['url'];
        }
    }
}

function routeEquals($name)
{
    $currentRoute = $_GET['url'] ?? "";

    foreach (routes() as $route) {
        if ($route['name'] == $name) {
            return $currentRoute == $route['url'];
        }
    }

    return false;
}

function redirect($name, $params = [])
{
    $url = '/davos-tech/';

    foreach (routes() as $route) {
        if ($route['name'] == $name) {

            foreach ($params as $key => $value) {
                $param = '{' . $key . '}';
                $route['url'] = str_replace($param, $value, $route['url']);
            }

            return header("location: " . $url . $route['url']);
        }
    }

    return routerView($_GET);
}
