<?php

namespace Model;

use Traits\TraitGetIp;

class UsuarioDAO extends ClassConexao {

    private $db;
    private $trait;
    private $dateNow;

    public function __construct() {
        $this->db = $this->conectaDB();
        $this->trait = TraitGetIp::getUserIp();
        $this->dateNow = date("Y-m-d H:i:s");
    }

    public function insertCad(Usuario $usuario, Confirmation $confirmation) {
        $sql = "INSERT INTO usuario(nome, sobrenome, email, usuario, senha, ativo) VALUES(:nome, :sobrenome, :email, :usuario, :senha, 0)";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':nome', $usuario->getNome());
        $prepare->bindValue(':sobrenome', $usuario->getSobrenome());
        $prepare->bindValue(':email', $usuario->getEmail());
        $prepare->bindValue(':usuario', $usuario->getUsuario());
        $prepare->bindValue(':senha', $usuario->getSenha());

        $prepare->execute();

        $id_inserido = $this->db->lastInsertId();

        $sql = "INSERT INTO permissoes(id_usuario, codigo_permissao) VALUES(:id_usuario, :codigo_permissao)";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':id_usuario', $id_inserido);
        $prepare->bindValue(':codigo_permissao', 2);

        $prepare->execute();

        $this->insertConfirmation($confirmation);
    }

    public function ativarUsuario($email) {
        $sql = "UPDATE usuario SET ativo = 1 WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $email);

        $prepare->execute();
    }

    public function alterarSenhaUsuario($email, $senha) {
        $sql = "UPDATE usuario SET senha = :senha WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':senha', $senha);
        $prepare->bindValue(':email', $email);

        $prepare->execute();
    }

    public function getDataUser($email) {
        $sql = "SELECT CONCAT(U.nome, ' ', U.sobrenome) AS nome, U.email, U.ativo, U.senha, IF((SELECT id_usuario FROM permissoes WHERE id_usuario = U.id AND codigo_permissao = 2) IS NOT NULL, TRUE, FALSE) AS p_user, IF((SELECT id_usuario FROM permissoes WHERE id_usuario = U.id AND codigo_permissao = 1) IS NOT NULL, TRUE, FALSE) AS p_adm FROM usuario AS U WHERE U.email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $email);

        $prepare->execute();

        $f = $prepare->fetch(\PDO::FETCH_ASSOC);
        $r = $prepare->rowCount();

        return $arrData = [
            "data"=>$f,
            "rows"=>$r
        ];
    }
    
    public function getIssetEmail($email) {
        $sql = "SELECT id FROM usuario WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $email);

        $prepare->execute();

        return $prepare->rowCount();
    }

    public function getIssetUsuario($usuario) {
        $sql = "SELECT id FROM usuario WHERE usuario = :usuario";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':usuario', $usuario);

        $prepare->execute();

        return $prepare->rowCount();
    }

    public function insertConfirmation(Confirmation $confirmation) {
        $sql = "INSERT INTO confirmation(email, token) VALUES(:email, :token)";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $confirmation->getEmail());
        $prepare->bindValue(':token', $confirmation->getToken());

        $prepare->execute();
    }

    public function deleteConfirmation($email) {
        $sql = "DELETE FROM confirmation WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $email);

        $prepare->execute();
    }

    public function getIssetConfirmation(Confirmation $confirmation){
        $sql = "SELECT id FROM confirmation WHERE email = :email AND token = :token";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $confirmation->getEmail());
        $prepare->bindValue(':token', $confirmation->getToken());

        $prepare->execute();

        return $prepare->rowCount();
    }

    public function confirmationCad(Confirmation $confirmation) {
        $r = $this->getIssetConfirmation($confirmation);

        if ($r > 0) {
            $this->deleteConfirmation($confirmation->getEmail());
            $this->ativarUsuario($confirmation->getEmail());

            return true;
        } else {
            return false;
        }        
    }

    public function confirmationSen(Confirmation $confirmation, $hashSenha) {
        $r = $this->getIssetConfirmation($confirmation);
        
        if ($r > 0) {
            $this->deleteConfirmation($confirmation->getEmail());
            $this->alterarSenhaUsuario($confirmation->getEmail(), $hashSenha);
           
            return true;
        } else {
            return false;
        }        
    }

    public function insertAttempt() {
        if ($this->countAttempt() < 5) {
            $sql = "INSERT INTO attempt(ip, data_hora) VALUES(:ip, :data_hora)";

            $prepare = $this->db->prepare($sql);

            $prepare->bindValue(':ip', $this->trait);
            $prepare->bindValue(':data_hora', $this->dateNow);

            $prepare->execute();
        }
    }

    public function countAttempt() {
        $sql = "SELECT * FROM attempt WHERE ip = :ip";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':ip', $this->trait);

        $prepare->execute();

        $r = 0;

        while ($f = $prepare->fetch(\PDO::FETCH_ASSOC)) {
            if (strtotime($f["data_hora"]) > strtotime($this->dateNow)-1200) {
                $r++;
            }
        }

        return $r;
    }

    public function deleteAttempt() {
        $sql = "DELETE FROM attempt WHERE ip = :ip";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':ip', $this->trait);

        $prepare->execute();
    }
}