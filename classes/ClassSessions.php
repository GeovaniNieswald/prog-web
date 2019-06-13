<?php

namespace Classes;

use Model;
use Traits\TraitGetIp;

class ClassSessions {

    private $login;
    private $timeSession;
    private $timeCanary;

    public function __construct() {
        $this->timeSession = 432000; // 5 dias
        $this->timeCanary = 300;

        if (session_id() == '') {
            ini_set("session.save_handler", "files");
            ini_set("session.use_cookies", 1);
            ini_set("session.use_only_cookies", 1);
            ini_set("session.cookie_domain", DOMAIN);
            ini_set("session.cookie_httponly", 1);

            if (DOMAIN != "localhost") {
                ini_set("session.cookie_secure", 1);
            }

            #Criptografia das nossas sessions

            ini_set("session.entropy_length", 512);
            ini_set("session.entropy_file", '/dev/urandom');
            ini_set("session.hash_function", 'sha256');
            ini_set("session.hash_bits_per_character", 5);

            session_start();

            if (isset($_COOKIE['sessao'])) {    
                $cookie = json_decode($_COOKIE['sessao'], true);

                $_SESSION["canary"]  = $cookie['canary'];
                $_SESSION["login"]   = $cookie['login'];
                $_SESSION["time"]    = $cookie['time'];
                $_SESSION["name"]    = $cookie['name'];
                $_SESSION["email"]   = $cookie['email'];
                $_SESSION["user"]    = $cookie['user'];
                $_SESSION["adm"]     = $cookie['adm'];
                $_SESSION["lembrar"] = $cookie['lembrar'];
            }
        }

        $this->login = new Model\ClassLogin();
    }

    #Setar as sessões do nosso sistema
    public function setSessions($email, $lembrar) {
        $this->verifyIdSessions();

        $_SESSION["login"]   = true;
        $_SESSION["time"]    = time();
        $_SESSION["name"]    = $this->login->getDataUser($email)['data']['nome'];
        $_SESSION["email"]   = $this->login->getDataUser($email)['data']['email'];
        $_SESSION["user"]    = $this->login->getDataUser($email)['data']['p_user'];
        $_SESSION["adm"]     = $this->login->getDataUser($email)['data']['p_adm'];
        $_SESSION["lembrar"] = $lembrar;

        if ($lembrar) {
            $this->setCookie();
        }        
    }

    private function setCookie() {
        $cookie = [
            "login"   => $_SESSION["login"],
            "time"    => $_SESSION["time"],
            "name"    => $_SESSION["name"],
            "email"   => $_SESSION["email"],
            "user"    => $_SESSION["user"],
            "adm"     => $_SESSION["adm"],
            "canary"  => $_SESSION["canary"],
            "lembrar" => $_SESSION["lembrar"]
        ];

        setcookie('sessao', json_encode($cookie), (time() + $this->timeSession), "/");
    }

    #Proteger contra roubo de sessão
    public function setSessionCanary($par = null) {
        session_regenerate_id(true);

        if ($par == null) {
            $_SESSION['canary'] = [
                "birth" => time(),
                "IP" => TraitGetIp::getUserIp()
            ];
        } else {
            $_SESSION['canary']['birth'] = time();
        }
    }

    #Verificar a integridade da sessão
    public function verifyIdSessions() {
        if (!isset($_SESSION['canary'])) {
            $this->setSessionCanary();
        }
    
        if ($_SESSION['canary']['IP'] !== TraitGetIp::getUserIp()) {
            $this->destructSessions();
            $this->setSessionCanary();
        }
    
        if ($_SESSION['canary']['birth'] < time() - $this->timeCanary) {
            $this->setSessionCanary("time");
        }
    }

    #Validar as paginas internas do sistema
    public function verifyInsideSession($permition = null) {
        $this->verifyIdSessions();

        if (!isset($_SESSION['login']) || !isset($_SESSION['user']) || !isset($_SESSION['canary'])) {
            $this->destructSessions();

            if ($permition != null){
                echo "
                    <script>
                        alert('Você não está logado');
                        window.location.href='".DIRPAGE."login';
                    </script>
                ";
            }
        } else {
            if ($_SESSION['time'] >= time() - $this->timeSession) {
                $_SESSION['time'] = time();

                if ($_SESSION['lembrar']){
                    $this->setCookie();
                }

                if ($permition == null) {
                    echo "
                        <script>
                            window.location.href='".DIRPAGE."home';
                        </script>
                    ";
                } else {
                    if ($_SESSION['user'] == FALSE) {
                        $this->destructSessions();
    
                        echo "
                            <script>
                                alert('Você não tem a permissão básica para usar o site!');
                                window.location.href='".DIRPAGE."login';
                            </script>
                        ";
                    } else {
                        if ($permition == 'adm' && $_SESSION["adm"] == FALSE) {
                            echo "
                                <script>
                                    alert('Você não tem acesso a este conteúdo!');
                                    window.location.href='".DIRPAGE."home';
                                </script>
                            ";
                        }
                    }
                }
            } else {
                $this->destructSessions();

                if ($permition != null){
                    echo "
                        <script>
                            alert('Sua sessão expirou. Faça login novamente!');
                            window.location.href='".DIRPAGE."login';
                        </script>
                    ";
                }
            }
        }
    }

    #Destruir as sessoes existentes
    public function destructSessions() {
        foreach (array_keys($_SESSION) as $key) {
            unset($_SESSION[$key]);
        }

        if (isset($_COOKIE['sessao'])) {
            unset($_COOKIE['sessao']);
            setcookie('sessao', '', time() - 3600, '/'); // empty value and old timestamp
        }
    }
}