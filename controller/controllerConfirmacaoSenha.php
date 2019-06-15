<?php

$validate = new \Classes\ClassValidate();
$usuarioDB = new \Model\UsuarioDAO();

$confirmation = new \Model\Confirmation();
$confirmation->setEmail($email);
$confirmation->setToken($token);

if ($validate->validateConfSenha($senha, $senhaConf)){
    if ($validate->validateStrongSenha($senha)){
        if ($usuarioDB->confirmationSen($confirmation, $hashSenha)) {
            $arrResponse = [
                "retorno"=>"success",
                "erro"=>null
            ];
        } else {            
            $arrResponse = [
                "retorno"=>"erro",
                "erro"=>"Não foi possível confirmar seus dados!",
                "fatal"=>true
            ];
        }
    } else {
        $arrResponse = [
            "retorno"=>"erro",
            "erro"=>"Senha fraca!",
            "fatal"=>false
        ];
    }
} else {
    $arrResponse = [
        "retorno"=>"erro",
        "erro"=>"Senha diferente de confirmação de senha!",
        "fatal"=>false
    ];
}

echo json_encode($arrResponse);