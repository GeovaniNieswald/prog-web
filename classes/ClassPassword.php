<?php

namespace Classes;

use Model\ClassLogin;

class ClassPassword {

    private $db;

    public function __construct() {
        $this->db = new ClassLogin();
    }

    #Criar o hash da senha para salvar no banco de dados
    public function passwordHash($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    #Verificar se o hash da senha está correto
    public function verifyHash($email, $senha) {
        $hashDb = $this->db->getDataUser($email);
        return password_verify($senha, $hashDb["data"]["senha"]);
    }
}