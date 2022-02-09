<?php

function telefone($telefone)
{
    $length = strlen(preg_replace("/[^0-9]/", "", $telefone));
    if ($length == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
        return "+" . substr($telefone, 0, $length - 11) . " (" . substr($telefone, $length - 11, 2) . ") " . substr($telefone, $length - 9, 5) . "-" . substr($telefone, -4);
    }
    if ($length == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
        return "+" . substr($telefone, 0, $length - 10) . " (" . substr($telefone, $length - 10, 2) . ") " . substr($telefone, $length - 8, 4) . "-" . substr($telefone, -4);
    }
    if ($length == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
        return "(" . substr($telefone, 0, 2) . ") " . substr($telefone, 2, 5) . "-" . substr($telefone, 7, 11);
    }
    if ($length == 10) { // COM CÓDIGO DE ÁREA NACIONAL
        return "(" . substr($telefone, 0, 2) . ") " . substr($telefone, 2, 4) . "-" . substr($telefone, 6, 10);
    }
    if ($length <= 9) { // SEM CÓDIGO DE ÁREA
        return substr($telefone, 0, $length - 4) . "-" . substr($telefone, -4);
    }
}

function money($money)
{
    return number_format($money, 2, ",", ".");
}
