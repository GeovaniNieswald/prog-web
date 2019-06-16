<?php 

namespace Classes;

use Model;

class ClassFeed {

    public static function setFeed($id) {
        $perfil = DIRPAGE.'perfil/';

        $html = "";

        $feedItemDB = new Model\FeedItemDAO();

        $lista = $feedItemDB->consultarItensPorId($id);
        if ($lista != null) {
            foreach ($lista as $feedItem) {
                $publicacao           = $feedItem->isPublicacao();
                
                $id                   = $feedItem->getId().$publicacao;
                $idUsuario            = $feedItem->getIdUsuario();
                $nomeUsuario          = $feedItem->getNomeUsuario();
                $usuarioUsuario       = $feedItem->getUsuarioUsuario();
                $idCriador            = $feedItem->getIdCriador();
                $nomeCriador          = $feedItem->getNomeCriador();
                $usuarioCriador       = $feedItem->getUsuarioCriador();
                $imagemCriador        = ($feedItem->getImagemCriador() != null) ? DIRIMG.$feedItem->getImagemCriador().'.jpg' : DIRIMG.'user.svg' ;
                $idPublicacao         = $feedItem->getIdPublicacao();
                $dataHora             = $feedItem->getDataHora();
                $numLikes             = $feedItem->getNumLikes();
                $numCompartilhamentos = $feedItem->getNumCompartilhamentos();
                $conteudo             = $feedItem->getConteudo();
                $compartilhou         = $feedItem->getCompartilhou();
                $curtiu               = $feedItem->getCurtiu();

                $acaoHoverComp      = ($compartilhou) ? "" : "onmouseover=\"hover('share', ".$id.")\"";
                $acaoHoverOutComp   = ($compartilhou) ? "" : "onmouseout=\"hoverOut('share', ".$id.")\"";
                $acaoHoverCurtiu    = ($curtiu) ? "" : "onmouseover=\"hover('like', ".$id.")\"";
                $acaoHoverOutCurtiu = ($curtiu) ? "" : "onmouseout=\"hoverOut('like', ".$id.")\"";

                $iconeCompartilhou  = ($compartilhou) ? DIRICONE."compartilhar.svg" : DIRICONE."compartilhar-off.svg";
                $iconeCurtiu        = ($curtiu) ? DIRICONE."curtir.svg" : DIRICONE."curtir-off.svg";

                $corCompartilhou  = ($compartilhou) ? "cor-verde" : "cor-cinza";
                $corCurtiu        = ($curtiu) ? "cor-vermelha" : "cor-cinza";

                if ($publicacao == 1) {
                    $html .= "<li class='row border-b fundo-hover'>\n";
                    $html .= "  <div class='col-2 text-center p-0'>\n";
                    $html .= "      <a href='".$perfil.$usuarioCriador."' class='link'><img class='mt-3 img-redonda' src='".$imagemCriador."' alt='Imagem de perfil'></a>\n";
                    $html .= "  </div>\n";
                    $html .= "  <div class='col-10 pl-0 pt-3 pb-3 pr-4'>\n";
                    $html .= "      <div class='row m-0 d-inline-block w-100'>\n";
                    $html .= "          <a class='float-left link' href='".$perfil.$usuarioCriador."'><p class='d-inline mr-2 font-weight-bold'>".$nomeCriador."</p><p class='d-inline texto-secundario'>@".$usuarioCriador."</p></a><p class='float-right mb-0'>".$dataHora."</p>\n";
                    $html .= "      </div>\n";
                    $html .= "      <div class='row m-0 fr-view'>".$conteudo."</div>\n";
                    $html .= "      <div class='row mt-2 mb-0 ml-0 mr-0 justify-content-center'>\n";
                    $html .= "          <div class='col text-center'>\n";
                    $html .= "              <div class='d-inline-block align-middle link' ".$acaoHoverComp." ".$acaoHoverOutComp." onclick='compartilhar()'>\n";
                    $html .= "                  <img id='img-share-publi-".$id."' class='icone-24' src='".$iconeCompartilhou."' alt='Compartilhar'>\n";
                    $html .= "                  <p id='p-share-publi-".$id."' class='d-inline align-middle ml-2 ".$corCompartilhou."'>".$numCompartilhamentos."</p>\n";
                    $html .= "              </div>\n";
                    $html .= "          </div>\n";
                    $html .= "          <div class='col'>\n";
                    $html .= "              <div class='d-inline-block align-middle link' ".$acaoHoverCurtiu." ".$acaoHoverOutCurtiu." onclick=\"curtir('".$id."', ".$curtiu.", ".$idPublicacao.")\">\n";
                    $html .= "                  <img id='img-like-publi-".$id."' class='icone-24' src='".$iconeCurtiu."' alt='Curtir'>\n";
                    $html .= "                  <p id='p-like-publi-".$id."' class='d-inline align-middle ml-2 ".$corCurtiu."'>".$numLikes."</p>\n";
                    $html .= "              </div>\n";
                    $html .= "          </div>\n";
                    $html .= "      </div>\n";
                    $html .= "  </div>\n";
                    $html .= "</li>\n";
                } else {
                    $html .= "<li class='row border-b fundo-hover'>\n";
                    $html .= "  <div class='col'>\n";
                    $html .= "      <div class='row pl-5 pt-2'>\n";
                    $html .= "          <a class='link' href='".$perfil.$usuarioUsuario."'><img class='d-inline icone-17' src='".DIRICONE."compartilhar-off.svg' alt='Compartilhou'><p class='d-inline ml-2 texto-secundario'>".$nomeUsuario."</p><p class='d-inline mb-0 ml-1 texto-secundario'>compartilhou</p></a>\n";
                    $html .= "      </div>\n";
                    $html .= "      <div class='row'>\n";
                    $html .= "          <div class='col-2 text-center p-0'>\n";
                    $html .= "              <a href='".$perfil.$usuarioCriador."' class='link'><img class='mt-2 img-redonda' src='".$imagemCriador."' alt='Imagem de perfil'></a>\n";
                    $html .= "          </div>\n";
                    $html .= "          <div class='col-10 pl-0 pt-2 pb-3 pr-4'>\n";
                    $html .= "              <div class='row m-0 d-inline-block w-100'>\n";
                    $html .= "                  <a class='float-left link' href='".$perfil.$usuarioCriador."'><p class='d-inline mr-2 font-weight-bold'>".$nomeCriador."</p><p class='d-inline texto-secundario'>@".$usuarioCriador."</p></a><p class='float-right mb-0'>".$dataHora."</p>\n";
                    $html .= "              </div>\n";
                    $html .= "              <div class='row m-0 fr-view'>".$conteudo."</div>\n";
                    $html .= "              <div class='row mt-2 mb-0 ml-0 mr-0 justify-content-center'>\n";
                    $html .= "                  <div class='col text-center'>\n";
                    $html .= "                      <div class='d-inline-block align-middle link' ".$acaoHoverComp." ".$acaoHoverOutComp." onclick='compartilhar()'>\n";
                    $html .= "                          <img id='img-share-publi-".$id."' class='icone-24' src='".$iconeCompartilhou."' alt='Compartilhar'>\n";
                    $html .= "                          <p id='p-share-publi-".$id."' class='d-inline align-middle ml-2 ".$corCompartilhou."'>".$numCompartilhamentos."</p>\n";
                    $html .= "                      </div>\n";
                    $html .= "                  </div>\n";
                    $html .= "                  <div class='col'>\n";
                    $html .= "                      <div class='d-inline-block align-middle link' ".$acaoHoverCurtiu." ".$acaoHoverOutCurtiu." onclick=\"curtir('".$id."', ".$curtiu.", ".$idPublicacao.")\">\n";
                    $html .= "                          <img id='img-like-publi-".$id."' class='icone-24' src='".$iconeCurtiu."' alt='Curtir'>\n";
                    $html .= "                          <p id='p-like-publi-".$id."' class='d-inline align-middle ml-2 ".$corCurtiu."'>".$numLikes."</p>\n";
                    $html .= "                      </div>\n";
                    $html .= "                  </div>\n";
                    $html .= "              </div>\n";
                    $html .= "          </div>\n";
                    $html .= "      </div>\n";
                    $html .= "  </div>\n";
                    $html .= "</li>\n";
                }
            }
        } else {
            $html .= "<li class='row'>\n";
            $html .= "  <div class='col-12 p-4'>\n";
            $html .= "      <div class='row m-0'>\n";
            $html .= "          Não existem publicações para você!\n";
            $html .= "      </div>\n";
            $html .= "  </div>\n";
            $html .= "</li>\n";
        }

        /*
        $html .= "<li class='row border-b fundo-hover'>\n";
        $html .= "  <div class='col-2 text-center p-0'>\n";
        $html .= "      <a href='".$perfil."gustavo' class='link'><img class='mt-3 img-redonda' src='".DIRIMG."gustavo.jpg' alt='Imagem de perfil'></a>\n";
        $html .= "  </div>\n";
        $html .= "  <div class='col-10 pl-0 pt-3 pb-3 pr-4'>\n";
        $html .= "      <div class='row m-0 d-inline-block w-100'>\n";
        $html .= "          <a class='float-left link' href='".$perfil."gustavo'><p class='d-inline mr-2 font-weight-bold'>Gustavo</p><p class='d-inline texto-secundario'>@gustavo</p></a><p class='float-right mb-0'>21/03/19 14:32</p>\n";
        $html .= "      </div>\n";
        $html .= "      <div class='row m-0 fr-view'>\n";
        $html .= "          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n";
        $html .= "      </div>\n";
        $html .= "      <div class='row mt-2 mb-0 ml-0 mr-0 justify-content-center'>\n";
        $html .= "          <div class='col text-center'>\n";
        $html .= "              <div class='d-inline-block align-middle link' onmouseover=\"hover('share', 451)\" onmouseout=\"hoverOut('share', 451)\" onclick='compartilhar()'>\n";
        $html .= "                  <img id='img-share-publi-451' class='icone-24' src='".DIRICONE."compartilhar-off.svg' alt='Compartilhar'>\n";
        $html .= "                  <p id='p-share-publi-451' class='d-inline align-middle ml-2 cor-cinza'>356</p>\n";
        $html .= "              </div>\n";
        $html .= "          </div>\n";
        $html .= "          <div class='col'>\n";
        $html .= "              <div class='d-inline-block align-middle link' onmouseover=\"hover('like', 451)\" onmouseout=\"hoverOut('like', 451)\" onclick='curtir()'>\n";
        $html .= "                  <img id='img-like-publi-451' class='icone-24' src='".DIRICONE."curtir-off.svg' alt='Curtir'>\n";
        $html .= "                  <p id='p-like-publi-451' class='d-inline align-middle ml-2 cor-cinza'>15</p>\n";
        $html .= "              </div>\n";
        $html .= "          </div>\n";
        $html .= "      </div>\n";
        $html .= "  </div>\n";
        $html .= "</li>\n";
        */

        echo $html; 
    }
}