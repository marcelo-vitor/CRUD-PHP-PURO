<?php

class CursoController
{
    public function index()
    {
        if (count($_POST) != 0) {
            if ($_POST['flag'] == 'delete') {
                Curso::delete($_POST['id']);
            }
        }

        $cursos = Curso::all();

        return view('Curso/index', [
            'cursos' => $cursos
        ]);
    }

    public function create()
    {
        if (count($_POST) != 0) {

            $validate = new Validate();

            $validate->max('nome', 15, 'string');
            $validate->min('nome', 6, 'string');
            $validate->required('nome');

            if ($validate->validate()) {
                Curso::create($_POST);
            }
        }

        return view('Curso/create');
    }

    public function update()
    {

        if (count($_POST) != 0) {

            $validate = new Validate();

            $validate->max('nome', 15, 'string');
            $validate->min('nome', 6, 'string');
            $validate->required('nome');

            if ($validate->validate()) {
                Curso::update($_POST);
            }
        }

        $curso = Curso::find($_GET['id']);

        return view('Curso/update', [
            'curso' => $curso
        ]);
    }

    public function show()
    {
        $curso = Curso::find($_GET['id']);

        return view('Curso/show', [
            'curso' => $curso
        ]);
    }
}
