<?php

namespace Classes;

use Model\UsuarioDAO;

class ClassPassword {

    private $usuarioDB;

    public function __construct() {
        $this->usuarioDB = new UsuarioDAO();
    }

    #Criar o hash da senha para salvar no banco de dados
    public function passwordHash($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    #Verificar se o hash da senha está correto
    public function verifyHash($email, $senha) {
        $usuario = $this->usuarioDB->consultarUsuarioPorEmail($email);
        
        return password_verify($senha, $usuario->getSenha());
    }
}