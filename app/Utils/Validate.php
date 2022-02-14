<?php

class Validate
{
    public $error = false;

    public function required($name)
    {
        if (!$_POST[$name]) {
            $this->error = true;
            flash($name, "Este campo é obrigatório");
        }
    }

    public function max($name, $length, $type = "numeric")
    {
        if ($type == 'string') {
            if (strlen($_POST[$name]) > $length) {
                $this->error = true;
                flash($name, "Este campo aceita no máximo " . $length . " caracteres");
            }
            return;
        }


        if ($_POST[$name] > $length) {
            $this->error = true;
            flash($name, "Este campo aceita no máximo " . $length);
        }
    }

    public function min($name, $length, $type = "numeric")
    {
        if ($type == 'string') {
            if (strlen($_POST[$name]) < $length) {
                $this->error = true;
                flash($name, "Este campo aceita no mínimo " . $length . " caracteres");
            }
            return;
        }


        if ($_POST[$name] < $length) {
            $this->error = true;
            flash($name, "Este campo aceita no mínimo " . $length);
        }
    }

    public function email($name)
    {
        if (filter_var($_POST[$name], FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        $this->error = true;
        flash($name, "Informe um email válido!");
    }

    public function validate()
    {
        if ($this->error) {
            return false;
        }

        return true;
    }
}
