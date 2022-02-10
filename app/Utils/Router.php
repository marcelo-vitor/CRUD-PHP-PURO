<?php

function routes()
{
    return [
        [
            "name" => "index",
            "url" => "",
            "action" => 'AlunoController:index'
        ],
        [
            "name" => "create",
            "url" => "create",
            "action" => 'AlunoController:create'
        ],
        [
            "name" => 'update',
            'url' => 'update',
            "action" => 'AlunoController:update'
        ],
        [
            "name" => 'show',
            'url' => 'show',
            "action" => 'AlunoController:show'
        ],
        [
            "name" => "curso.index",
            "url" => "curso",
            "action" => 'CursoController:index'
        ],
        [
            "name" => "curso.create",
            "url" => "curso/create",
            "action" => 'CursoController:create'
        ],
        [
            "name" => 'curso.update',
            'url' => 'curso/update',
            "action" => 'CursoController:update'
        ],
        [
            "name" => 'curso.show',
            'url' => 'curso/show',
            "action" => 'CursoController:show'
        ]
    ];
}

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
