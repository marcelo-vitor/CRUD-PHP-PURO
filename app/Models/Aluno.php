<?php

class Aluno
{
    public static function all()
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM alunos ORDER BY id ASC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('Aluno')) {
            $resultado[] = $row;
        }

        return $resultado;
    }

    public static function find($id)
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM alunos WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Aluno');

        return $resultado;
    }

    public static function create($dados)
    {
        $con = Connection::getConn();

        $sql = $con->prepare(
            'INSERT INTO alunos (email, senha, telefone, valor_mensalidade, situacao, observacao) 
            VALUES (:email, :senha, :telefone, :valor_mensalidade, :situacao, :observacao)'
        );
        $sql->bindValue(':email', $dados['email']);
        //$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $sql->bindValue(':senha', $dados['senha']);
        $sql->bindValue(':telefone', $dados['telefone']);
        $sql->bindValue(':valor_mensalidade', $dados['valor_mensalidade']);
        $sql->bindValue(':situacao', $dados['situacao']);
        $sql->bindValue(':observacao', $dados['observacao']);
        $res = $sql->execute();

        if ($res) {
            $_SESSION['sucesso'] = "Aluno cadastrado com sucesso!";
            return self::find($con->lastInsertId());
        }

        $_SESSION['error'] = "Ocorreu um erro inesperado, tente novamente mais tarde!";
        return [];
    }

    public static function update($dados)
    {
        $con = Connection::getConn();

        $sql = "UPDATE alunos SET email = :email, senha = :senha, telefone = :telefone, valor_mensalidade = :valor_mensalidade, situacao = :situacao, observacao = :observacao WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':email', $dados['email']);
        //$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $sql->bindValue(':senha', $dados['senha']);
        $sql->bindValue(':telefone', $dados['telefone']);
        $sql->bindValue(':valor_mensalidade', $dados['valor_mensalidade']);
        $sql->bindValue(':situacao', $dados['situacao']);
        $sql->bindValue(':observacao', $dados['observacao']);
        $sql->bindValue(':id', $dados['id']);
        $res = $sql->execute();

        if ($res) {
            $_SESSION['sucesso'] = "Aluno cadastrado com sucesso!";
            return self::find($dados['id']);
        }

        $_SESSION['error'] = "Ocorreu um erro inesperado, tente novamente mais tarde!";
        return [];
    }

    public static function delete($id)
    {
        $con = Connection::getConn();

        $sql = "DELETE FROM alunos WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if ($resultado == 0) {
            return false;
        }

        $_SESSION['sucesso'] = "Aluno excluido com sucesso!";
        return true;
    }
}
