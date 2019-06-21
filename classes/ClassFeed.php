<?php 

namespace Classes;

use Model;

class ClassFeed {

    public static function setFeed($id) {
        $perfil = DIRPAGE.'perfil/';

        $idUsuarioSistema = $id;

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
                $imagemCriador        = ($feedItem->getImagemCriador() != null) ? DIRIMG.$feedItem->getImagemCriador() : DIRIMG.'user.svg' ;
                $idPublicacao         = $feedItem->getIdPublicacao();
                $dataHora             = $feedItem->getDataHora();
                $numLikes             = $feedItem->getNumLikes();
                $numCompartilhamentos = $feedItem->getNumCompartilhamentos();
                $conteudo             = $feedItem->getConteudo();
                $compartilhou         = $feedItem->getCompartilhou();
                $curtiu               = $feedItem->getCurtiu();

                $acaoHoverComp      = "onmouseover=\"hover('share', ".$id.")\"";
                $acaoHoverOutComp   = "onmouseout=\"hoverOut('share', ".$id.")\"";
                $acaoHoverCurtiu    = "onmouseover=\"hover('like', ".$id.")\"";
                $acaoHoverOutCurtiu = "onmouseout=\"hoverOut('like', ".$id.")\"";

                $acaoClickCurtir    = "onclick=\"curtir('".$id."', ".$idPublicacao.", ".$idUsuarioSistema.")\"";
                $acaoClickComp      = "onclick=\"compartilhar('".$id."', ".$idPublicacao.", ".$idUsuarioSistema.", ".$idCriador.")\"";

                $iconeCompartilhou  = ($compartilhou) ? DIRICONE."compartilhar.svg" : DIRICONE."compartilhar-off.svg";
                $iconeCurtiu        = ($curtiu) ? DIRICONE."curtir.svg" : DIRICONE."curtir-off.svg";

                $corCompartilhou  = ($compartilhou) ? "cor-verde compartilhou" : "cor-cinza";
                $corCurtiu        = ($curtiu) ? "cor-vermelha curtiu" : "cor-cinza";

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
                    $html .= "              <div class='d-inline-block align-middle link' ".$acaoHoverComp." ".$acaoHoverOutComp." ".$acaoClickComp.">\n";
                    $html .= "                  <img id='img-share-publi-".$id."' class='icone-24' src='".$iconeCompartilhou."' alt='Compartilhar'>\n";
                    $html .= "                  <p id='p-share-publi-".$id."' class='d-inline align-middle ml-2 ".$corCompartilhou."'>".$numCompartilhamentos."</p>\n";
                    $html .= "              </div>\n";
                    $html .= "          </div>\n";
                    $html .= "          <div class='col'>\n";
                    $html .= "              <div class='d-inline-block align-middle link' ".$acaoHoverCurtiu." ".$acaoHoverOutCurtiu." ".$acaoClickCurtir.">\n";
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
                    $html .= "                      <div class='d-inline-block align-middle link' ".$acaoHoverComp." ".$acaoHoverOutComp." ".$acaoClickComp.">\n";
                    $html .= "                          <img id='img-share-publi-".$id."' class='icone-24' src='".$iconeCompartilhou."' alt='Compartilhar'>\n";
                    $html .= "                          <p id='p-share-publi-".$id."' class='d-inline align-middle ml-2 ".$corCompartilhou."'>".$numCompartilhamentos."</p>\n";
                    $html .= "                      </div>\n";
                    $html .= "                  </div>\n";
                    $html .= "                  <div class='col'>\n";
                    $html .= "                      <div class='d-inline-block align-middle link' ".$acaoHoverCurtiu." ".$acaoHoverOutCurtiu." ".$acaoClickCurtir.">\n";
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

        echo $html; 
    }

    public static function setPubliComps($id, $ehPerfilProprio) {
        $idUsuarioSistema = $id;

        $html = "";

        $feedItemDB = new Model\FeedItemDAO();

        $lista = $feedItemDB->consultarItensPorId($id, true);
        if ($lista != null) {
            foreach ($lista as $feedItem) {
                $publicacao    = $feedItem->isPublicacao();
                
                $id            = $feedItem->getId();
                $dataHora      = $feedItem->getDataHora();
                $conteudo      = $feedItem->getConteudo();

                $conteudoAux   = $conteudo;

                $conteudoLimpo = strip_tags($conteudo);

                if ($publicacao == 1) {
                    $html .= "<tr>\n";
                    $html .= "  <td>".$dataHora."</td>\n";
                    $html .= "  <td>".substr($conteudoLimpo, 0, 10)."...</td>\n";

                    ($ehPerfilProprio) ? $html .= "  <td><a href='#' data-toggle='modal' data-target='#myModal' class='cor-verde' onclick=\"editar(".$id.", '".$conteudoAux."')\"><i class='fas fa-edit'></i></a></td>\n" : "";
                    ($ehPerfilProprio) ? $html .= "  <td><a href='#' class='cor-vermelha' onclick=\"apagar(".$id.")\"><i class='fas fa-trash'></i></a></td>\n" : "";
                    
                    $html .= "</tr>\n";
                } 
            }
        } 

        echo $html; 
    }
}