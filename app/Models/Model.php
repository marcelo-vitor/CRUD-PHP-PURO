<?php

abstract class Model
{
    protected $table;

    protected $attributes;

    public static function find($id)
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM " . (new static)->table . " WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject(get_class(new static));

        return $resultado;
    }

    public static function all()
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM " . (new static)->table . " ORDER BY id ASC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject(get_class(new static))) {
            $resultado[] = $row;
        }

        return $resultado;
    }

    public static function create($dados)
    {
        $con = Connection::getConn();

        $attrs = self::getAttrs();
        $binds = self::getBinds();

        $sql = $con->prepare(
            'INSERT INTO ' . (new static)->table . " ( $attrs ) VALUES ( $binds )"
        );

        $sql = self::bindValues($sql, $dados);
        $res = $sql->execute();

        if ($res) {
            $_SESSION['sucesso'] = get_class(new static) . " cadastrado com sucesso!";
            return self::find($con->lastInsertId());
        }

        $_SESSION['error'] = "Ocorreu um erro inesperado, tente novamente mais tarde!";
        return [];
    }

    public static function update($dados)
    {
        $con = Connection::getConn();

        $sql = "UPDATE " . (new static)->table . " SET " . self::getAttrsBinds() . " WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql = self::bindValues($sql, $dados);
        $res = $sql->execute();

        if ($res) {
            $_SESSION['sucesso'] = get_class(new static) . " atualizado com sucesso!";
            return self::find($dados['id']);
        }

        $_SESSION['error'] = "Ocorreu um erro inesperado, tente novamente mais tarde!";
        return [];
    }

    public static function delete($id)
    {
        $con = Connection::getConn();

        $sql = "DELETE FROM " . (new static)->table . " WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if ($resultado == 0) {
            return false;
        }

        $_SESSION['sucesso'] = get_class(new static) . " excluido com sucesso!";
        return true;
    }

    public static function bindValues($prepare, $values)
    {

        foreach ($values as $key => $value) {
            $bind = ':' . $key;
            $prepare->bindValue($bind, $value);
        }

        return $prepare;
    }

    public static function getAttrsBinds()
    {
        $attributes = (new static)->attributes;
        $attrsBinds = '';

        foreach ($attributes as $attribute) {
            $attrsBinds .= $attribute . ' = :' . $attribute . ',';
        }

        return rtrim($attrsBinds, ',');
    }

    public static function getAttrs()
    {
        $attributes = (new static)->attributes;
        $attrs = '';

        foreach ($attributes as $attribute) {
            $attrs .= ' ' . $attribute . ',';
        }

        return rtrim($attrs, ',');
    }

    public static function getBinds()
    {
        $attributes = (new static)->attributes;
        $attrs = '';

        foreach ($attributes as $attribute) {
            $attrs .= ' :' . $attribute . ',';
        }

        return rtrim($attrs, ',');
    }
}
