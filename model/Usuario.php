<?php 

namespace Model;

class Usuario {

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $usuario;
    private $senha;
    private $nascimento;
    private $sexo;
    private $celular;
    private $imagem;
    private $cidade;
    private $bio;
    private $ativo;

    public function __construct() {
    }

	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
    }

    public function setSobrenome($sobrenome){
		$this->sobrenome = $sobrenome;
	}
	public function getSobrenome(){
		return $this->sobrenome;
    }
    
	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
    }
    
    public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	public function getUsuario(){
		return $this->usuario;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function getSenha(){
		return $this->senha;
    }	

    public function setNascimento($nascimento){
		$this->nascimento = $nascimento;
	}
	public function getNascimento(){
		return $this->nascimento;
    }
    
    public function setSexo($sexo){
		$this->sexo = $sexo;
	}
	public function getSexo(){
		return $this->sexo;
    }
    
    public function setCelular($celular){
		$this->celular = $celular;
	}
	public function getCelular(){
		return $this->celular;
	}

    public function setImagem($imagem){
		$this->imagem = $imagem;
	}
	public function getImagem(){
		return $this->imagem;
	}

    public function setCidade($cidade){
		$this->cidade = $cidade;
	}
	public function getCidade(){
		return $this->cidade;
	}

    public function setBio($bio){
		$this->bio = $bio;
	}
	public function getBio(){
		return $this->bio;
    }
    
    public function setAtivo($ativo){
		$this->ativo = $ativo;
	}
	public function isAtivo(){
		return $this->ativo;
	}
}