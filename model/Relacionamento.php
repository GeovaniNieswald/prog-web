<?php 

namespace Model;

class Relacionamento {

    private $idSeguidor;
    private $idSeguido;

    public function __construct() {
    }

	public function setIdSeguidor($idSeguidor){
		$this->idSeguidor = $idSeguidor;
	}
	public function getIdSeguidor(){
		return $this->idSeguidor;
	}

	public function setIdSeguido($idSeguido){
		$this->idSeguido = $idSeguido;
	}
	public function getIdSeguido(){
		return $this->idSeguido;
    }
}