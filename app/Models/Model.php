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

    public static function create($dados, $columns = null)
    {
        $con = Connection::getConn();

        $attrs = self::getAttrs($columns);
        $binds = self::getBinds($columns);

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

    public static function update($dados, $columns = null)
    {
        $con = Connection::getConn();

        $sql = "UPDATE " . (new static)->table . " SET " . self::getAttrsBinds($columns) . " WHERE id = :id";
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

    private static function bindValues($prepare, $values)
    {

        foreach ($values as $key => $value) {
            $bind = ':' . $key;
            $prepare->bindValue($bind, $value);
        }

        return $prepare;
    }

    private static function getAttrsBinds($columns = null)
    {
        $attributes = $columns ?? (new static)->attributes;
        $attrsBinds = '';

        foreach ($attributes as $attribute) {
            $attrsBinds .= $attribute . ' = :' . $attribute . ',';
        }

        return rtrim($attrsBinds, ',');
    }

    private static function getAttrs($columns = null)
    {
        $attributes = $columns ?? (new static)->attributes;
        $attrs = '';

        foreach ($attributes as $attribute) {
            $attrs .= ' ' . $attribute . ',';
        }

        return rtrim($attrs, ',');
    }

    private static function getBinds($columns = null)
    {
        $attributes = $columns ?? (new static)->attributes;
        $attrs = '';

        foreach ($attributes as $attribute) {
            $attrs .= ' :' . $attribute . ',';
        }

        return rtrim($attrs, ',');
    }

    public static function getColumns()
    {
        $con = Connection::getConn();
        $sql = $con->prepare('show columns from ' . (new static)->table);
        $sql->execute();

        $res = [];

        while ($row = $sql->fetch()) {
            $res[$row['Field']] = true;
        }

        return $res;
    }

    // relacionamentos

    public function belongsTo($class, $localKey, $foreignKey)
    {
        $con = Connection::getConn();
        $sql = $con->prepare("SELECT * FROM " . (new $class)->table . " where " . $foreignKey . " = " . $this->$localKey);
        $sql->execute();

        $result = $sql->fetchObject($class);

        return $result;
    }

    public function hasOne($class, $foreignKey, $onwerKey)
    {
        $con = Connection::getConn();
        $sql = $con->prepare("SELECT * FROM " . (new $class)->table . " where " . $onwerKey . " = " . $this->$foreignKey);
        $sql->execute();

        $result = $sql->fetchObject($class);

        return $result;
    }

    public function hasMany($class, $foreignKey, $onwerKey)
    {
        $con = Connection::getConn();
        $sql = $con->prepare("SELECT * FROM " . (new $class)->table . " where " . $onwerKey . " = " . $this->$foreignKey);
        $sql->execute();

        $result = [];
        while ($row = $sql->fetchObject($class)) {
            $result[] = $row;
        }

        return $result;
    }

    // metodos

    public function save()
    {
        $columns = self::getColumns();
        $attrsAll = $this->getAllAttrs();

        foreach ($attrsAll as $key => $value) {
            if (!array_key_exists($key, $columns)) {
                unset($attrsAll[$key]);
            }
        }

        if (empty($attrsAll['id'])) {
            $novo = self::create($attrsAll, array_keys($attrsAll));
            $this->id = $novo->id;
        } else {
            self::update($attrsAll, array_keys($attrsAll));
        }
    }

    private function getAllAttrs()
    {
        $array = [];

        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }
}
