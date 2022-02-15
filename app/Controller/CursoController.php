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

    public function delete($params)
    {

        Curso::delete($params['id']);


        return redirect('curso.index');
    }

    public function create()
    {
        return view('Curso/create');
    }

    public function store()
    {
        $validate = new Validate();

        $validate->max('nome', 15, 'string');
        $validate->min('nome', 6, 'string');
        $validate->required('nome');

        if ($validate->validate()) {
            Curso::create($_POST);
        } else {
            setOld();
        }


        return redirect('curso.create');
    }

    public function update($params)
    {

        $curso = Curso::find($params['id']);

        if (!$curso) {
            echo "Curso não encontrado";
            return;
        }

        return view('Curso/update', [
            'curso' => $curso
        ]);
    }

    public function edit($params)
    {

        $validate = new Validate();

        $validate->max('nome', 15, 'string');
        $validate->min('nome', 6, 'string');
        $validate->required('nome');

        if ($validate->validate()) {
            Curso::update($_POST);
        } else {
            setOld();
        }


        return redirect('curso.update', ['id' => $params['id']]);
    }

    public function show($params)
    {
        $curso = Curso::find($params['id']);

        if (!$curso) {
            echo "Curso não encontrado";
            return;
        }

        return view('Curso/show', [
            'curso' => $curso
        ]);
    }
}
