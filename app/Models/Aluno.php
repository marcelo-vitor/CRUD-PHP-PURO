<?php

class Aluno extends Model
{
    protected $table = "alunos";

    protected $attributes = [
        'email',
        'senha',
        'telefone',
        'valor_mensalidade',
        'situacao',
        'observacao'
    ];
}
