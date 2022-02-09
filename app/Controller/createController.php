<?php

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

    if (!$validate->error) {
        $result = Aluno::create($_POST);
    } else {
        setOld();
    }
}
