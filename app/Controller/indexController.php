<?php

if (count($_POST) != 0) {
    if ($_POST['flag'] == 'delete') {
        Aluno::delete($_POST['id']);
    }
}
