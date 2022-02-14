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
