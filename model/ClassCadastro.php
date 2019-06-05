<?php

namespace Model;

class ClassCadastro extends ClassCrud {

    public function insertCad($arrVar) {
        $id_inserido = $this->insertDB(
            "usuario", 
            "nome, sobrenome, email, usuario, senha, ativo", 
            "?, ?, ?, ?, ?, ?", 
            array(
                $arrVar['nome'],
                $arrVar['sobrenome'],
                $arrVar['email'],
                $arrVar['usuario'],
                $arrVar['hashSenha'],
                0
           )
        );

        $this->insertDB(
            "permissoes",
            "id_usuario, codigo_permissao",
            "?, ?",
            array(
                $id_inserido,
                2
            )
        );

        $this->insertDB(
            "confirmation",
            "email, token",
            "?, ?",
            array(
                $arrVar['email'],
                $arrVar['token']
            )
        );
    }

    # Verificar diretamente no banco se o email está cadastrado
    public function getIssetEmail($email) {
        $b = $this->selectDB(
            "id",
            "usuario",
            "WHERE email = ?",
            array($email)
        );

        return $b->rowCount();
    }

     # Verificar diretamente no banco se o usuario está cadastrado
     public function getIssetUsuario($usuario) {
        $b = $this->selectDB(
            "id",
            "usuario",
            "WHERE usuario = ?",
            array($usuario)
        );

        return $b->rowCount();
    }
}