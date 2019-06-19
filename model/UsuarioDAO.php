<?php

namespace Model;

use Traits\TraitGetIp;

class UsuarioDAO extends ClassConexao {

    private $db;
    private $ip;
    private $dateNow;

    public function __construct() {
        $this->db = $this->conectaDB();
        $this->ip = TraitGetIp::getUserIp();
        $this->dateNow = date("Y-m-d H:i:s");
    }

    public function inserirUsuario(Usuario $usuario, Confirmation $confirmation) {
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

        $this->inserirConfirmation($confirmation);
    }

    public function consultarUsuarioPorId($id) {
        return $this->consultarUsuario($id);
    }
    
    public function consultarUsuarioPorEmail($email) {
        return $this->consultarUsuario($email, false);
    }

    public function consultarPermissaoPorIdUsuario($id, $cod_permissao) {
        $sql = "SELECT codigo_permissao FROM permissoes WHERE id_usuario = :id AND codigo_permissao = :cod_permissao";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':id', $id);
        $prepare->bindValue(':cod_permissao', $cod_permissao);

        if ($prepare->execute()) {
           return true;
        } else {
            return false;
        }
    }

    public function emailExiste($email) {
        $sql = "SELECT id FROM usuario WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $email);

        $prepare->execute();

        return ($prepare->rowCount() > 0);
    }

    public function usuarioExiste($usuario) {
        $sql = "SELECT id FROM usuario WHERE usuario = :usuario";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':usuario', $usuario);

        $prepare->execute();

        return ($prepare->rowCount() > 0);
    }

    public function inserirConfirmation(Confirmation $confirmation) {
        $sql = "INSERT INTO confirmation(email, token) VALUES(:email, :token)";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $confirmation->getEmail());
        $prepare->bindValue(':token', $confirmation->getToken());

        $prepare->execute();
    }

    public function confirmarCadastro(Confirmation $confirmation) {
        $confirmationExiste = $this->confirmationExiste($confirmation);

        if ($confirmationExiste) {
            $this->removerConfirmation($confirmation->getEmail());
            $this->ativarUsuario($confirmation->getEmail());

            return true;
        } else {
            return false;
        }        
    }

    public function confirmarTrocaDeSenha(Confirmation $confirmation, $hashSenha) {
        $confirmationExiste = $this->confirmationExiste($confirmation);
        
        if ($confirmationExiste) {
            $this->removerConfirmation($confirmation->getEmail());
            $this->alterarSenhaUsuario($confirmation->getEmail(), $hashSenha);
           
            return true;
        } else {
            return false;
        }        
    }

    public function inserirAttempt() {
        if ($this->countAttempt() < 5) {
            $sql = "INSERT INTO attempt(ip, data_hora) VALUES(:ip, :data_hora)";

            $prepare = $this->db->prepare($sql);

            $prepare->bindValue(':ip', $this->ip);
            $prepare->bindValue(':data_hora', $this->dateNow);

            $prepare->execute();
        }
    }

    public function countAttempt() {
        $sql = "SELECT * FROM attempt WHERE ip = :ip";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':ip', $this->ip);

        $prepare->execute();

        $r = 0;

        while ($f = $prepare->fetch(\PDO::FETCH_ASSOC)) {
            if (strtotime($f["data_hora"]) > strtotime($this->dateNow)-1200) {
                $r++;
            }
        }

        return $r;
    }

    public function removerAttempt() {
        $sql = "DELETE FROM attempt WHERE ip = :ip";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':ip', $this->ip);

        $prepare->execute();
    }

    private function ativarUsuario($email) {
        $sql = "UPDATE usuario SET ativo = 1 WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $email);

        $prepare->execute();
    }

    private function alterarSenhaUsuario($email, $senha) {
        $sql = "UPDATE usuario SET senha = :senha WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':senha', $senha);
        $prepare->bindValue(':email', $email);

        $prepare->execute();
    }

    private function removerConfirmation($email) {
        $sql = "DELETE FROM confirmation WHERE email = :email";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $email);

        $prepare->execute();
    }

    private function confirmationExiste(Confirmation $confirmation){
        $sql = "SELECT id FROM confirmation WHERE email = :email AND token = :token";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':email', $confirmation->getEmail());
        $prepare->bindValue(':token', $confirmation->getToken());

        $prepare->execute();

        return ($prepare->rowCount() > 0);
    }

    private function consultarUsuario($campo, $id = true) {
        $sql = ($id) ? "SELECT * FROM usuario WHERE id = :campo" : "SELECT * FROM usuario WHERE email = :campo" ;

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':campo', $campo);

        if ($prepare->execute()) {
            while ($dados = $prepare->fetch(\PDO::FETCH_OBJ)) {
                $usuario = new Usuario();
                
                $usuario->setId($dados->id);       
                $usuario->setNome($dados->nome);
                $usuario->setSobrenome($dados->sobrenome);
                $usuario->setEmail($dados->email);
                $usuario->setUsuario($dados->usuario);
                $usuario->setSenha($dados->senha);
                $usuario->setNascimento($dados->nascimento);                
                $usuario->setSexo($dados->sexo);
                $usuario->setCelular($dados->celular);
                $usuario->setImagem($dados->imagem);
                $usuario->setIdCidade($dados->id_cidade);
                $usuario->setBio($dados->bio);
                $usuario->setAtivo($dados->ativo);

                return $usuario;
            }
        }
    }
}