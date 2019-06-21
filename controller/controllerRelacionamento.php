<?php 

$relacionamentoDB = new Model\RelacionamentoDAO();

$tipo      = (isset($_POST['tipo'])) ? $_POST['tipo'] : null;
$idAlvo    = (isset($_POST['idAlvo'])) ? $_POST['idAlvo'] : null;
$idUsuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : null;

if ($tipo != null) {
    switch ($tipo) {
        case "seguir":
            $resultado = $relacionamentoDB->seguir($idAlvo, $idUsuario);
        
            if ($resultado) {
                $arrResponse = [
                    "retorno"=>"success"
                ];
            } else {
                $arrResponse = [
                    "retorno"=>"erro"
                ];
            }
            
            break;
        case "pararSeguir":
            $resultado = $relacionamentoDB->pararSeguir($idAlvo, $idUsuario);
        
            if ($resultado) {
                $arrResponse = [
                    "retorno"=>"success"
                ];
            } else {
                $arrResponse = [
                    "retorno"=>"erro"
                ];
            }
            
            break;
    }

    echo json_encode($arrResponse);
}