<?php

namespace Model;

use Traits\TraitGetIp;

class ClassLogin extends ClassCrud {

    private $trait;
    private $dateNow;

    public function __construct() {
        $this->trait = TraitGetIp::getUserIp();
        $this->dateNow = date("Y-m-d H:i:s");
    }

    #Retorna dados do usuário
    public function getDataUser($email) {
        $b = $this->selectDB(
            "CONCAT(U.nome, ' ', U.sobrenome) AS nome, U.email, U.ativo, U.senha, IF((SELECT id_usuario FROM permissoes WHERE id_usuario = U.id AND codigo_permissao = 2) IS NOT NULL, TRUE, FALSE) AS p_user, IF((SELECT id_usuario FROM permissoes WHERE id_usuario = U.id AND codigo_permissao = 1) IS NOT NULL, TRUE, FALSE) AS p_adm", 
            "usuario AS U", 
            "WHERE U.email = ?", 
            array(
                $email
            )
        );

        $f = $b->fetch(\PDO::FETCH_ASSOC);
        $r = $b->rowCount();

        return $arrData = [
            "data"=>$f,
            "rows"=>$r
        ];
    }

    #Conta as tentativas
    public function countAttempt() {
        $b = $this->selectDB(
            "*", 
            "attempt", 
            "WHERE ip = ?",
            array(
                $this->trait
            )
        );

        $r = 0;

        while ($f = $b->fetch(\PDO::FETCH_ASSOC)) {
            if (strtotime($f["data_hora"]) > strtotime($this->dateNow)-1200) {
                $r++;
            }
        }

        return $r;
    }

    #Inserir as tentativas
    public function insertAttempt() {
        if ($this->countAttempt() < 5) {
            $this->insertDB(
                "attempt",
                "ip, data_hora", 
                "?, ?",
                array(
                    $this->trait,
                    $this->dateNow
                )
            );
        }
    }

    #Deleta as tentativas
    public function deleteAttempt() {
        $this->deleteDB(
            "attempt",
            "ip = ?",
            array(
                $this->trait
            )
        );
    }
}