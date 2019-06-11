<?php

namespace Classes;

use Model\ClassCadastro;
use Model\ClassLogin;
use ZxcvbnPhp\Zxcvbn;
use Classes\ClassPassword;
use Classes\ClassSessions;
use Classes\ClassMail;

class ClassValidate {

    private $erro = [];
    private $cadastro;
    private $password;
    private $login;
    private $tentativas;
    private $session;
    private $mail;

    public function __construct() {
        $this->cadastro = new ClassCadastro();
        $this->password = new ClassPassword();
        $this->login    = new ClassLogin();
        $this->session  = new ClassSessions();
        $this->mail     = new ClassMail();
    }

    public function getErro() {
        return $this->erro;
    }

    public function setErro($erro) {
        array_push($this->erro, $erro);
    }

    # Validar se os campos desejados foram preenchidos
    public function validateFields($par) {
        $i = 0;

        foreach ($par as $key => $value) {
            if (empty($value)) {
                $i++;
            }
        }

        if ($i == 0) {
            return true;
        } else {
            $this->setErro("Preencha todos os dados!");
            return false;
        }
    }

    #Validação se o dado é um email
    public function validateEmail($par) {
        if (filter_var($par, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->setErro("Email inválido!");
            return false;
        }
    }

    #Validar se o email existe no banco de dados (action null para cadastro)
    public function validateIssetEmail($email, $action = null) {
        $b = $this->cadastro->getIssetEmail($email);

        if ($action == null) {
            if ($b > 0) {
                $this->setErro("Email já cadastrado!");
                return false;
            } else {
                return true;
            }
        } else {
            if ($b > 0) {
                return true;
            } else {
                $this->setErro("Email não cadastrado!");
                return false;                
            }
        }
    }

    #Validar se o usuario existe no banco de dados (action null para cadastro)
    public function validateIssetUsuario($usuario, $action = null) {
        $b = $this->cadastro->getIssetUsuario($usuario);

        if ($action == null) {
            if ($b > 0) {
                $this->setErro("@ já está em uso!");
                return false;
            } else {
                return true;
            }
        } else {
            if ($b > 0) {
                return true;
            } else {
                $this->setErro("Usuário não cadastrado!");
                return false;                
            }
        }
    }

    #Outras validações......... https://www.youtube.com/watch?v=fhvm2_4AXoA

    #Verificar se a senha é igual a confirmação de senha
    public function validateConfSenha($senha, $senhaConf) {
        if ($senha === $senhaConf) {
            return true;
        } else {
            $this->setErro("Senha diferente de confirmação de senha!");
            return false;
        }
    }

    #Verificar a força da senha (action = null cadastro)
    public function validateStrongSenha($senha, $action = null) {
        $zxcvbn = new Zxcvbn();
        $strength = $zxcvbn->passwordStrength($senha);
       
        if ($action == null) {
            if ($strength['score'] >= 3) {
                return true;
            } else {
                $this->setErro("Utilize uma senha mais forte!");
                return false;
            }
        } else {
            # login
        }
    }

    #Verificação da senha digitada com o hash no banco de dados
    public function validateSenha($email, $senha) {
        if ($this->password->verifyHash($email, $senha)) {
            return true;
        } else {
            $this->setErro("Usuário ou Senha inválidos!");
            return false;
        }
    }

    #Validação final do cadastro
    public function validateFinalCad($arrVar) {
        if (count($this->getErro()) > 0) {
            $arrResponse = [
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        } else {
            $this->mail->sendMail(
                $arrVar['email'], 
                $arrVar['nome'], 
                $arrVar['token'], 
                "Confirmação de Cadastro", 
                "
                <strong>Cadastro Poligno News</strong><br>
                Confirme seu email <a href='".DIRPAGE."controller/controllerConfirmacao/{$arrVar['email']}/{$arrVar['token']}'>clicando aqui</a>
                "
            );

            $arrResponse = [
                "retorno"=>"success",
                "erros"=>null
            ];

            $this->cadastro->insertCad($arrVar);
        }

        return json_encode($arrResponse);
    }

    #Validação das tentativas
    public function validateAttemptLogin() {
        if ($this->login->countAttempt() >= 5) {
            $this->setErro("Você realizou mais de 5 tentativas!");
            $this->tentativas = true;
            return false;
        } else {
            $this->tentativas = false;
            return true;
        }
    }

    #Metodo de validação de confirmação de email
    public function validateUserActive($email) {
        $user = $this->login->getDataUser($email);

        if ($user["data"]["ativo"] == 0) {
            $this->setErro("Usuário não está ativo!");
            return false;
        } else {
            return true;
        }
    }

    #Validação final do login
    public function validateFinalLogin($email) {
        if (count($this->getErro()) > 0) {
            $this->login->insertAttempt();
           
            $arrResponse = [
                "retorno"=>"erro",
                "erros"=>$this->getErro(),
                "tentativas"=>$this->tentativas
            ];
        } else {
            $this->login->deleteAttempt();
            $this->session->setSessions($email);

            $arrResponse = [
                "retorno"=>"success",
                "page"=>'home',
                "tentativas"=>$this->tentativas
            ];
        }

        return json_encode($arrResponse);
    }

    public function validateFinalSen($arrVar) {
        if (count($this->getErro()) > 0) {
            $arrResponse = [
                "retorno"=>"erro",
                "erros"=>$this->getErro()
            ];
        } else {
            $this->mail->sendMail(
                $arrVar['email'], 
                $arrVar['nome'], 
                $arrVar['token'], 
                "Link para Redefinição de Senha", 
                "
                <strong>Redefinição de Senha Poligno News</strong><br>
                Redefina sua senha <a href='".DIRPAGE."redefinicao-senha/{$arrVar['email']}/{$arrVar['token']}'>clicando aqui</a>
                "
            );

            $arrResponse = [
                "retorno"=>"success",
                "erros"=>null
            ];

            $this->cadastro->insertConfirmation($arrVar);
        }

        return json_encode($arrResponse);
    }
}