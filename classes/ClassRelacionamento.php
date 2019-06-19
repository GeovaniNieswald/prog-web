<?php 

namespace Classes;

use Model;

class ClassRelacionamento {

    public static function setSeguidores($id, $pagPerfil = FALSE) {
        $perfil = DIRPAGE.'perfil/';

        $html  = "";

        $relacionamentoDB = new Model\RelacionamentoDAO();
        $usuarioDB        = new Model\UsuarioDAO();

        $lista = $relacionamentoDB->consultarRelacionamentosPorId($id, true, true);
        if ($lista != null) {
            foreach ($lista as $relacionamento) {
                $usuario = $usuarioDB->consultarUsuarioPorId($relacionamento->getIdSeguidor());

                $imagem = ($usuario->getImagem() != null) ? DIRIMG.$usuario->getImagem().'.jpg' : DIRIMG.'user.svg' ;

                $html .= "<li>\n";
                $html .= "  <a class='row border-b pt-2 pb-2 link fundo-hover' href='".$perfil.$usuario->getUsuario()."'>\n";
                $html .= "      <div class='col-4 text-center m-auto'>\n";
                $html .= "          <img class='img-redonda-pequena' src='".$imagem."' alt='Imagem de perfil'>\n";
                $html .= "      </div>\n";
                $html .= "      <div class='col-8 line-height-normal'>\n";
                $html .= "          <div class='row font-weight-bold'>".$usuario->getNome()."</div>\n";
                $html .= "          <div class='row texto-secundario'>@".$usuario->getUsuario()."</div>\n";
                $html .= "      </div>\n";
                $html .= "  </a>\n";
                $html .= "</li>\n";
            }
        } else {
            $txt = ($pagPerfil) ? "Essa pessoa" : "Você";

            $html .= "<li>\n";
            $html .= "  <div class='row border-b pt-2 pb-2 fundo-hover'>\n";
            $html .= "      <div class='col-12 line-height-normal'>\n";
            $html .= "          <div class='row p-3 texto-secundario'>".$txt." não tem nenhum seguidor!</div>\n";
            $html .= "      </div>\n";
            $html .= "  </div>\n";
            $html .= "</li>\n";
        }

        echo $html;
    }

    public static function setSeguindo($id, $pagPerfil = FALSE) {
        $perfil = DIRPAGE.'perfil/';

        $html  = "";

        $relacionamentoDB = new Model\RelacionamentoDAO();
        $usuarioDB        = new Model\UsuarioDAO();

        $lista = $relacionamentoDB->consultarRelacionamentosPorId($id, false, true);
        if ($lista != null) {
            foreach ($lista as $relacionamento) {
                $usuario = $usuarioDB->consultarUsuarioPorId($relacionamento->getIdSeguido());

                $imagem = ($usuario->getImagem() != null) ? DIRIMG.$usuario->getImagem().'.jpg' : DIRIMG.'user.svg' ;

                $html .= "<li>\n";
                $html .= "  <a class='row border-b pt-2 pb-2 link fundo-hover' href='".$perfil.$usuario->getUsuario()."'>\n";
                $html .= "      <div class='col-4 text-center m-auto'>\n";
                $html .= "          <img class='img-redonda-pequena' src='".$imagem."' alt='Imagem de perfil'>\n";
                $html .= "      </div>\n";
                $html .= "      <div class='col-8 line-height-normal'>\n";
                $html .= "          <div class='row font-weight-bold'>".$usuario->getNome()."</div>\n";
                $html .= "          <div class='row texto-secundario'>@".$usuario->getUsuario()."</div>\n";
                $html .= "      </div>\n";
                $html .= "  </a>\n";
                $html .= "</li>\n";
            }
        } else {
            $txt = ($pagPerfil) ? "Essa pessoa" : "Você";

            $html .= "<li>\n";
            $html .= "  <div class='row border-b pt-2 pb-2 fundo-hover'>\n";
            $html .= "      <div class='col-12 line-height-normal'>\n";
            $html .= "          <div class='row p-3 texto-secundario'>".$txt." não segue ninguém!</div>\n";
            $html .= "      </div>\n";
            $html .= "  </div>\n";
            $html .= "</li>\n";
        }

        echo $html;
    }
}