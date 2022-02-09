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
        'observacao',
        'curso_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'id');
    }
}
