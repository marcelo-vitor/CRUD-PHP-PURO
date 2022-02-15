<?php

class CursoController
{
    public function index($request)
    {
        $cursos = Curso::all();

        return view('Curso/index', [
            'cursos' => $cursos
        ]);
    }

    public function delete($request, $id)
    {
        Curso::delete($id);

        return redirect('curso.index');
    }

    public function create()
    {
        return view('Curso/create');
    }

    public function store($request)
    {
        $validate = new Validate();

        $validate->max('nome', 15, 'string');
        $validate->min('nome', 6, 'string');
        $validate->required('nome');

        if ($validate->validate()) {
            Curso::create($request->all());
        } else {
            setOld();
        }


        return redirect('curso.create');
    }

    public function update($request, $id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            echo "Curso não encontrado";
            return;
        }

        return view('Curso/update', [
            'curso' => $curso
        ]);
    }

    public function edit($request, $id)
    {
        $validate = new Validate();

        $validate->max('nome', 15, 'string');
        $validate->min('nome', 6, 'string');
        $validate->required('nome');

        if ($validate->validate()) {
            Curso::update($request->all());
        } else {
            setOld();
        }


        return redirect('curso.update', ['id' => $id]);
    }

    public function show($request, $id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            echo "Curso não encontrado";
            return;
        }

        return view('Curso/show', [
            'curso' => $curso
        ]);
    }
}
