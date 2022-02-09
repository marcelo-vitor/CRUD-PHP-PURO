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

    public function validate()
    {
        if ($this->error) {
            setOld();
            return false;
        }

        return true;
    }
}
