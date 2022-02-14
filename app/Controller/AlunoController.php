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
        if (count($_POST) != 0) {
            if ($_POST['flag'] == 'delete') {
                Aluno::delete($_POST['id']);
            }
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
        if (count($_POST) != 0) {

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
        }

        return redirect('create');
    }

    public function update()
    {
        $aluno = Aluno::find($_GET['id']);

        $cursos = Curso::all();

        return view('Aluno/update', [
            'aluno' => $aluno,
            'cursos' => $cursos
        ]);
    }

    public function edit()
    {
        if (count($_POST) != 0) {

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
        }

        return redirect('update', '?id=' . $_POST['id']);
    }

    public function show()
    {
        $aluno = Aluno::find($_GET['id']);

        return view('Aluno/show', [
            'aluno' => $aluno
        ]);
    }
}
