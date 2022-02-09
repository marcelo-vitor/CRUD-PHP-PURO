<?php

class Curso extends Model
{
    protected $table = 'cursos';

    protected $attributes = [
        'nome'
    ];

    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'id', 'curso_id');
    }
}
