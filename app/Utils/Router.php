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
            "name" => "delete",
            "url" => "delete",
            "action" => 'AlunoController:delete'
        ],
        [
            "name" => "create",
            "url" => "create",
            "action" => 'AlunoController:create'
        ],
        [
            "name" => "store",
            "url" => "store",
            "action" => 'AlunoController:store'
        ],
        [
            "name" => 'update',
            'url' => 'update',
            "action" => 'AlunoController:update'
        ],
        [
            "name" => 'edit',
            'url' => 'edit',
            "action" => 'AlunoController:edit'
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
            "name" => "curso.delete",
            "url" => "curso/delete",
            "action" => 'CursoController:delete'
        ],
        [
            "name" => "curso.create",
            "url" => "curso/create",
            "action" => 'CursoController:create'
        ],
        [
            "name" => "curso.store",
            "url" => "curso/store",
            "action" => 'CursoController:store'
        ],
        [
            "name" => 'curso.update',
            'url' => 'curso/update',
            "action" => 'CursoController:update'
        ],
        [
            "name" => 'curso.edit',
            'url' => 'curso/edit',
            "action" => 'CursoController:edit'
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
