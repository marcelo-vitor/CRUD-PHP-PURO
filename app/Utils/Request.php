<?php

class Request
{
    private $data = [];

    public function __construct()
    {
        $this->data = $_POST;
    }

    public function __get($attr)
    {
        return $this->data[$attr];
    }

    public function __set($attr, $value)
    {
        $this->data[$attr] = $value;
    }

    public function all()
    {
        return $this->data;
    }

    public function only($attrs)
    {
        $newData = [];
        foreach ($attrs as $attr) {
            if (array_key_exists($attr, $this->data)) {
                $newData[$attr] = $this->data[$attr];
            }
        }
        return $newData;
    }

    public function except($attrs)
    {
        $newData = $this->data;
        foreach ($attrs as $attr) {
            if (array_key_exists($attr, $newData)) {
                unset($newData[$attr]);
            }
        }
        return $newData;
    }
}
