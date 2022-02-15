<?php

class AlunoController
{
    public function index()
    {
        $alunos = Aluno::all();

        return view('Aluno/index', [
            'alunos' => $alunos
        ]);
    }

    public function delete()
    {
        if ($_POST['flag'] == 'delete') {
            Aluno::delete($_POST['id']);
        }

        return redirect('index');
    }

    public function create()
    {
        $cursos = Curso::all();

        return view('Aluno/create', [
            'cursos' => $cursos
        ]);
    }

    public function store()
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
            Aluno::create($_POST);
        } else {
            setOld();
        }


        return redirect('create');
    }

    public function update($params)
    {
        $cursos = Curso::all();
        $aluno = Aluno::find($params['id']);

        if (!$aluno) {
            echo "Aluno não encontrado";
            return;
        }

        return view('Aluno/update', [
            'aluno' => $aluno,
            'cursos' => $cursos
        ]);
    }

    public function edit($params)
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
            Aluno::update($_POST);
        } else {
            setOld();
        }


        return redirect('update', ['id' => $params['id']]);
    }

    public function show($params)
    {
        $aluno = Aluno::find($params['id']);

        if (!$aluno) {
            echo "Aluno não encontrado";
            return;
        }

        return view('Aluno/show', [
            'aluno' => $aluno
        ]);
    }
}
