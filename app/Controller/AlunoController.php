<?php

class AlunoController
{
    public function index()
    {
        if (count($_POST) != 0) {
            if ($_POST['flag'] == 'delete') {
                Aluno::delete($_POST['id']);
            }
        }

        $alunos = Aluno::all();

        return view('Aluno/index', [
            'alunos' => $alunos
        ]);
    }

    public function create()
    {
        if (count($_POST) != 0) {

            $validate = new Validate();

            $validate->required('email');

            $validate->max('senha', 10, 'string');
            $validate->min('senha', 6, 'string');
            $validate->required('senha');

            $validate->required('telefone');

            $validate->max('valor_mensalidade', 2000);
            $validate->required('valor_mensalidade');

            $validate->required('observacao');

            if ($validate->validate()) {
                Aluno::create($_POST);
            }
        }

        return view('Aluno/create');
    }

    public function update()
    {

        if (count($_POST) != 0) {

            $validate = new Validate();

            $validate->required('email');

            $validate->max('senha', 10, 'string');
            $validate->min('senha', 6, 'string');
            $validate->required('senha');

            $validate->required('telefone');

            $validate->max('valor_mensalidade', 2000);
            $validate->required('valor_mensalidade');

            $validate->required('observacao');

            if ($validate->validate()) {
                $result = Aluno::update($_POST);
            }
        }

        $aluno = Aluno::find($_GET['id']);

        return view('Aluno/update', [
            'aluno' => $aluno
        ]);
    }

    public function show()
    {
        $aluno = Aluno::find($_GET['id']);

        return view('Aluno/show', [
            'aluno' => $aluno
        ]);
    }
}
