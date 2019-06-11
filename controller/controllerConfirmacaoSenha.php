<?php

$validate = new \Classes\ClassValidate();
$confirmation = new \Model\ClassCadastro();

if ($validate->validateConfSenha($senha, $senhaConf)){
    if ($validate->validateStrongSenha($senha)){
        if ($confirmation->confirmationSen($email, $token, $hashSenha)) {
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