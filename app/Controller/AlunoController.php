<?php

class AlunoController
{
    public function index($request)
    {
        $alunos = Aluno::all();

        return view('Aluno/index', [
            'alunos' => $alunos
        ]);
    }

    public function delete($request, $id)
    {
        if ($request->flag == 'delete') {
            Aluno::delete($id);
        }

        return redirect('index');
    }

    public function create($request)
    {
        $cursos = Curso::all();

        return view('Aluno/create', [
            'cursos' => $cursos
        ]);
    }

    public function store($request)
    {

        $validate = new Validate();

        $validate->required('email');
        $validate->email('email');

        $validate->max('senha', 10, 'string');
        $validate->min('senha', 6, 'string');
        $validate->required('senha');

        $validate->required('telefone');

        $validate->max('valor_mensalidade', 2000);
        $validate->required('valor_mensalidade');

        $validate->required('observacao');

        $validate->required('curso_id');

        if ($validate->validate()) {
            Aluno::create($request->all());
        } else {
            setOld();
        }


        return redirect('create');
    }

    public function update($request, $id)
    {
        $cursos = Curso::all();
        $aluno = Aluno::find($id);

        if (!$aluno) {
            echo "Aluno não encontrado";
            return;
        }

        return view('Aluno/update', [
            'aluno' => $aluno,
            'cursos' => $cursos
        ]);
    }

    public function edit($request, $id)
    {
        $validate = new Validate();

        $validate->required('email');
        $validate->email('email');

        $validate->max('senha', 10, 'string');
        $validate->min('senha', 6, 'string');
        $validate->required('senha');

        $validate->required('telefone');

        $validate->max('valor_mensalidade', 2000);
        $validate->required('valor_mensalidade');

        $validate->required('observacao');

        $validate->required('curso_id');

        if ($validate->validate()) {
            Aluno::update($request->all());
        } else {
            setOld();
        }


        return redirect('update', ['id' => $id]);
    }

    public function show($request, $id)
    {
        $aluno = Aluno::find($id);

        if (!$aluno) {
            echo "Aluno não encontrado";
            return;
        }

        return view('Aluno/show', [
            'aluno' => $aluno
        ]);
    }
}
