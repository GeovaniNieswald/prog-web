<?php

namespace Classes;

class ClassLayout {

    public static function setHeadRestrito($permition) {
        $session = new ClassSessions();
        $session->verifyInsideSession($permition);
    }

    public static function setHeadInicial() {
        $session = new ClassSessions();
        $session->verifyInsideSession();
    }

    # Setar as tags do head
    public static function setHead($title, $description, $faPag = FALSE, $froalaPag = FALSE) {
        $bootstrap = DIRCSS.'bootstrap.min.css';
        $favicon   = DIRICONE.'favicon.png';
        $estilo    = DIRCSS.'estilo.css';
        $froala    = DIRTEMA.'froala-editor-custom-theme.css';

        $html  = "<!DOCTYPE html>\n";
        $html .= "<html lang='pt-br'>\n";
        $html .= "<head>\n";
        $html .= "  <meta charset='utf-8'>\n";
        $html .= "  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>\n";
        $html .= "  <meta name='author' content='Geovani Alex Nieswald'>\n";
        $html .= "  <meta name='format-detection' content='telephone=no'>\n";
        $html .= "  <meta name='description' content='$description'>\n\n";

        $html .= "  <link rel='icon' href='$favicon'>\n\n";

        $html .= "  <link rel='stylesheet' type='text/css' href='$bootstrap'>\n";   
        $html .= "  <link rel='stylesheet' type='text/css' href='$estilo'>\n";

        if ($faPag) {
            $html .= "\n  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' integrity='sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf' crossorigin='anonymous'>\n";
        }

        if ($froalaPag) {
            $html .= "\n  <!-- Include external CSS - Froala Editor. -->\n";
            $html .= "  <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>\n";
            $html .= "  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css'>\n\n";

            $html .= "  <!-- Include Editor style - Froala Editor. -->\n";
            $html .= "  <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.3/css/froala_editor.pkgd.min.css'>\n";
            $html .= "  <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.3/css/froala_style.min.css'>\n";
            $html .= "  <link rel='stylesheet' type='text/css' href='$froala'>\n";
        }

        $html .= "\n";
        
        $html .= "  <title>$title</title>\n";
        $html .= "</head>\n";

        if ($froalaPag) {
            $html .= "<body class='p-0' onload='posicionarBotaoFixo()' onresize='posicionarBotaoFixo()'>\n";
        } else {
            $html .= "<body>\n";
        }

        echo $html;
    }

    # Setar as tags do footer
    public static function setFooter($froalaPag = FALSE) {
        $jquery        = DIRJS.'jquery-3.3.1.min.js';
        $bootstrap     = DIRJS.'bootstrap.min.js';
        $vanillaMasker = DIRJS.'vanilla-masker.min.js';
        $script        = DIRJS.'script.js';
        $lingua        = DIRLIN.'froala-editor-pt_br.js';

        $html  = "<script type='text/javascript' src='$jquery'></script>\n";
        $html .= "<script type='text/javascript' src='$bootstrap'></script>\n";
        $html .= "<script type='text/javascript' src='$vanillaMasker'></script>\n";
        $html .= "<script type='text/javascript' src='$script'></script>\n\n";

        if ($froalaPag) {
            $html .= "<!-- Include external JS libs - Froala Editor. -->\n";
            $html .= "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js'></script>\n";
            $html .= "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js'></script>\n\n";
       
            $html .= "<!-- Include Editor JS files - Froala Editor. -->\n";
            $html .= "<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@2.9.3/js/froala_editor.pkgd.min.js'></script>\n\n";

            $html .= "<!-- Include language file - Froala Editor. -->\n";
            $html .= "<script src='$lingua'></script>\n\n";

            $html .= "<!-- Initialize the editor, and set language to pt_BR - Froala Editor. -->\n";
            $html .= "<script>$(function() { $('textarea').froalaEditor({ theme: 'custom', language: 'pt_br' }) });</script>\n";
        }
        
        $html .= "\n";

        $html .= "</body>\n";
        $html .= "</html>";

        echo $html;
    }
}