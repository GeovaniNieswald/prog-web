<?php

$objPass = new Classes\ClassPassword();

$nome      = (isset($_POST['nome'])) ? filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$sobrenome = (isset($_POST['sobrenome'])) ? filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$usuario   = (isset($_POST['usuario'])) ? filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$email     = (isset($_POST['email'])) ? filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) : null;
$senhaConf = (isset($_POST['senhaConf'])) ? $_POST['senhaConf'] : null;
$token     = (isset($_POST['token'])) ? $_POST['token'] : bin2hex(random_bytes(64));

if (isset($_POST['senha'])) {
    $senha = $_POST['senha']; 
    $hashSenha = $objPass->passwordHash($senha);
} else {
    $senha = null; 
    $hashSenha = null;
}

$arrVar = [
    "nome"=>$nome,
    "sobrenome"=>$sobrenome,
    "usuario"=>$usuario,
    "email"=>$email,
    "senha"=>$senha,
    "hashSenha"=>$hashSenha,
    "token"=>$token
];