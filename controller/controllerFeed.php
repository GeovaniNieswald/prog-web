<?php 

$feedItemDB = new Model\FeedItemDAO();

$tipo         = (isset($_POST['tipo'])) ? $_POST['tipo'] : null;
$idPublicacao = (isset($_POST['idPublicacao'])) ? $_POST['idPublicacao'] : null;
$idUsuario    = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : null;
$conteudo     = (isset($_POST['conteudo'])) ? $_POST['conteudo'] : null;
$idCriador    = (isset($_POST['idCriador'])) ? $_POST['idCriador'] : null;
$id           = (isset($_POST['id'])) ? $_POST['id'] : null;

if ($tipo != null) {
    switch ($tipo) {
        case "publicar":
            $resultado = $feedItemDB->publicar($conteudo, $idUsuario);
        
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
        case "compartilhar":
            $numComps = $feedItemDB->compartilhar($idPublicacao, $idCriador, $idUsuario);

            if ($numComps != 0) {
                $arrResponse = [
                    "retorno"=>"success",
                    "numComps"=>$numComps
                ];
            } else {
                $arrResponse = [
                    "retorno"=>"erro"
                ];
            }
    
            break;
        case "descompartilhar":
            $numComps = $feedItemDB->descompartilhar($idPublicacao, $idCriador, $idUsuario);

            if ($numComps != -1) {
                $arrResponse = [
                    "retorno"=>"success",
                    "numComps"=>$numComps
                ];
            } else {
                $arrResponse = [
                    "retorno"=>"erro"
                ];
            }
    
            break;
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

            break;
        case "editar":
            $resultado = $feedItemDB->editar($id, $conteudo);
        
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
        case "apagar":
            $resultado = $feedItemDB->apagar($id);
        
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