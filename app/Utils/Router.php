<?php

function pathPages()
{
    return "app/Pages";
}

function routes()
{
    return [
        [
            "name" => "index",
            "url" => "",
            "view" => "/Aluno/index"
        ],
        [
            "name" => "create",
            "url" => "create",
            "view" => "/Aluno/create"
        ],
        [
            "name" => 'update',
            'url' => 'update',
            "view" => '/Aluno/update'
        ],
        [
            "name" => 'show',
            'url' => 'show',
            "view" => '/Aluno/show'
        ]
    ];
}

function routerView($get)
{
    $currentRoute = $get['url'] ?? "";

    foreach (routes() as $route) {
        if ($route['url'] == $currentRoute) {
            require_once pathPages() . $route['view'] . '.php';
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
