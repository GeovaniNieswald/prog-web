<?php

namespace Classes;

use Model\UsuarioDAO;
use Model\Usuario;

class ClassUpload {

    private $usuarioDB;

    private $tiposPermitidos;
    private $tamanhoPermitido;
    private $arqName;
    private $arqType;
    private $arqSize;
    private $arqTemp;
    private $arqError;

    public function __construct($arqName, $arqType, $arqSize, $arqTemp, $arqError) {
        $this->usuarioDB = new UsuarioDAO();

        $this->tiposPermitidos = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
        $this->tamanhoPermitido = 1024 * 500; // 500 Kb

        $this->arqName  = $arqName;
        $this->arqType  = $arqType;
        $this->arqSize  = $arqSize;
        $this->arqTemp  = $arqTemp;
        $this->arqError = $arqError;
    }

    public function fazerUpload($arrVar){
        $this->arqError = ($this->arqName == null) ? 0 : $this->arqError;
        $this->arqType  = ($this->arqName == null) ? 'image/jpeg' : $this->arqType;

        if ($this->arqError == 0) {
            if (array_search($this->arqType, $this->tiposPermitidos)) {
                if ($this->arqSize <= $this->tamanhoPermitido) {
                    if ($this->arqName != null) {
                        $pasta = $_SERVER['DOCUMENT_ROOT']."/prog-web/recursos/imagens/";

                        $tmp = explode('.', $this->arqName);
                        $end = end($tmp);

                        $extensao      = strtolower($end);
                        $this->arqName = time().'.'.$extensao;
                        $upload        = move_uploaded_file($this->arqTemp, $pasta.$this->arqName);
                    } else {
                        $upload = true;
                    }                    
    
                    if ($upload == true) {
                        $usuario = new Usuario();
                        
                        $usuario->setEmail($arrVar['email']);
                        $usuario->setNome($arrVar['nome']);
                        $usuario->setSobrenome($arrVar['sobrenome']);
                        $usuario->setNascimento($arrVar['nascimento']);
                        $usuario->setSexo($arrVar['sexo']);
                        $usuario->setCelular($arrVar['celular']);
                        $usuario->setImagem($this->arqName);
                        $usuario->setCidade($arrVar['cidade']);
                        $usuario->setBio($arrVar['bio']);

                        $resposta = $this->usuarioDB->editarUsuario($usuario);

                        if ($resposta) {
                            return "Perfil editado com sucesso!";
                        } else {
                            return "Não foi possível editar o perfil!";
                        }
                    } else {
                        return "Não foi possível upar a imagem!";
                    }
                } else {
                    $this->tamanhoPermitido = $this->tamanhoPermitido/1024;
                    return "Não foi possível upar a imagem, o tamanho do arquivo selecionado é maior que o limite! (".$this->tamanhoPermitido." Kb)";
                }
            } else {
                return "Não foi possível upar a imagem, o tipo de arquivo selecionado é inválido!";                
            } 
        } else {
            return "Não foi possível upar a imagem!";
        }
    }
}