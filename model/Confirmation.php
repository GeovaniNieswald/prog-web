<?php 

namespace Model;

class Confirmation {

    private $id;
    private $email;
    private $token;

    public function __construct() {
    }

	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
 
	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
    }
    
    public function setToken($token){
		$this->token = $token;
	}
	public function getToken(){
		return $this->token;
    }
}