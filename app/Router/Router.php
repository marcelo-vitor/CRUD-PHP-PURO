<?php

function routerView($get)
{
    $currentRoute = $get['url'] ?? "";

    foreach (routes() as $route) {
        if ($route['url'] == $currentRoute) {
            $controller = explode(':', $route['action'])[0];
            $method = explode(':', $route['action'])[1];
            call_user_func(array(new $controller, $method));
            return;
        }
    }
}

function route($name, $params = null)
{
    $url = '/davos-tech/';

    foreach (routes() as $route) {
        if ($route['name'] == $name) {
            return $url . $route['url'] . $params ?? '';
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

function redirect($name, $params = null)
{
    $url = '/davos-tech/';

    foreach (routes() as $route) {
        if ($route['name'] == $name) {
            // return routerView(['url' => $route['url']]);
            return header("location: " . $url . $route['url'] . $params);
        }
    }

    return routerView($_GET);
}
