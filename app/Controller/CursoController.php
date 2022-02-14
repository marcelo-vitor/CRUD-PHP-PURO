<?php

class CursoController
{
    public function index()
    {
        $cursos = Curso::all();

        return view('Curso/index', [
            'cursos' => $cursos
        ]);
    }

    public function delete()
    {
        if (count($_POST) != 0) {
            if ($_POST['flag'] == 'delete') {
                Curso::delete($_POST['id']);
            }
        }

        return redirect('curso.index');
    }

    public function create()
    {
        return view('Curso/create');
    }

    public function store()
    {
        if (count($_POST) != 0) {

            $validate = new Validate();

            $validate->max('nome', 15, 'string');
            $validate->min('nome', 6, 'string');
            $validate->required('nome');

            if ($validate->validate()) {
                Curso::create($_POST);
            } else {
                setOld();
            }
        }

        return redirect('curso.create');
    }

    public function update()
    {

        $curso = Curso::find($_GET['id']);

        return view('Curso/update', [
            'curso' => $curso
        ]);
    }

    public function edit()
    {
        if (count($_POST) != 0) {

            $validate = new Validate();

            $validate->max('nome', 15, 'string');
            $validate->min('nome', 6, 'string');
            $validate->required('nome');

            if ($validate->validate()) {
                Curso::update($_POST);
            } else {
                setOld();
            }
        }

        return redirect('curso.update', "?id=" . $_POST['id']);
    }

    public function show()
    {
        $curso = Curso::find($_GET['id']);

        return view('Curso/show', [
            'curso' => $curso
        ]);
    }
}
