<?php 

$feedItemDB = new Model\FeedItemDAO();

$tipo         = $_POST['tipo'];
$idPublicacao = $_POST['idPublicacao'];
$idUsuario    = $_POST['idUsuario'];

if ($tipo != null) {
    switch ($tipo) {
        case "curtir":
            $numCurtidas = $feedItemDB->curtir($idPublicacao, $idUsuario);

            if ($numCurtidas != 0) {
                $arrResponse = [
                    "retorno"=>"success",
                    "numCurtidas"=>$numCurtidas
                ];
            } else {
                $arrResponse = [
                    "retorno"=>"erro"
                ];
            }
            
            echo json_encode($arrResponse);

            break;
        case "descurtir":
            $numCurtidas = $feedItemDB->descurtir($idPublicacao, $idUsuario);

            if ($numCurtidas != -1) {
                $arrResponse = [
                    "retorno"=>"success",
                    "numCurtidas"=>$numCurtidas
                ];
            } else {
                $arrResponse = [
                    "retorno"=>"erro"
                ];
            }
            
            echo json_encode($arrResponse);

            break;
        case "compartilhar":
           
        



            break;
    }
}