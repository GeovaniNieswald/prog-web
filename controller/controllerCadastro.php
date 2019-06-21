<?php

$validate = new Classes\ClassValidate();

$validate->validateFields($_POST);
$validate->validateEmail($email);
$validate->validateIssetEmail($email);
$validate->validateIssetUsuario($usuario);
$validate->validateConfSenha($senha, $senhaConf);
$validate->validateStrongSenha($senha);

echo $validate->validateFinalCad($arrVar);