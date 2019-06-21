<?php

$confirmation = new \Model\Confirmation();
$confirmation->setEmail(\Traits\TraitParseUrl::parseUrl(2));
$confirmation->setToken(\Traits\TraitParseUrl::parseUrl(3));

$usuarioDB = new \Model\UsuarioDAO();

if ($usuarioDB->confirmarCadastro($confirmation)) {
    echo "
    <script>
        alert('Dados confirmados com sucesso!');
        window.location.href='".DIRPAGE."index';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Não foi possível confirmar seus dados!');
        window.location.href='".DIRPAGE."index';
    </script>
    ";
}