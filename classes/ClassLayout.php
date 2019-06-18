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
        $favicon   = DIRICONE.'favicon/';
        $estilo    = DIRCSS.'estilo.css';
        $froala    = DIRCSS.'froala/';

        $html  = "<!DOCTYPE html>\n";
        $html .= "<html lang='pt-br'>\n";
        $html .= "<head>\n";
        $html .= "  <meta charset='utf-8'>\n";
        $html .= "  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>\n";
        $html .= "  <meta name='author' content='Geovani Alex Nieswald'>\n";
        $html .= "  <meta name='format-detection' content='telephone=no'>\n";
        $html .= "  <meta name='description' content='$description'>\n\n";

        $html .= "  <link rel='apple-touch-icon' sizes='180x180' href='".$favicon."apple-touch-icon.png'>\n";
        $html .= "  <link rel='icon' type='image/png' sizes='32x32' href='".$favicon."favicon-32x32.png'>\n";
        $html .= "  <link rel='icon' type='image/png' sizes='16x16' href='".$favicon."favicon-16x16.png'>\n";
        $html .= "  <link rel='manifest' href='".$favicon."site.webmanifest'>\n";
        $html .= "  <link rel='mask-icon' href='".$favicon."safari-pinned-tab.svg' color='#5bbad5'>\n";
        $html .= "  <link rel='shortcut icon' href='".$favicon."favicon.ico'>\n";
        $html .= "  <meta name='msapplication-TileColor' content='#1b95e0'>\n";
        $html .= "  <meta name='msapplication-config' content='".$favicon."browserconfig.xml'>\n";
        $html .= "  <meta name='theme-color' content='#ffffff'>\n\n";

        $html .= "  <link rel='stylesheet' type='text/css' href='$bootstrap'>\n";   
        $html .= "  <link rel='stylesheet' type='text/css' href='$estilo'>\n";

        if ($faPag) {
            $html .= "\n  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' integrity='sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf' crossorigin='anonymous'>\n";
        }

        if ($froalaPag) {            
            $html .= "  <link href='".$froala."froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />\n";
            $html .= "  <link href='".$froala."froala_style.min.css' rel='stylesheet' type='text/css' />\n";
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
        $jquery        = DIRJS.'jquery-3.4.1.min.js';
        $bootstrap     = DIRJS.'bootstrap.min.js';
        $vanillaMasker = DIRJS.'vanilla-masker.min.js';
        $script        = DIRJS.'script.js';
        $froala        = DIRJS.'froala/';

        $html  = "<script type='text/javascript' src='$jquery'></script>\n";
        $html .= "<script type='text/javascript' src='$bootstrap'></script>\n";
        $html .= "<script type='text/javascript' src='$vanillaMasker'></script>\n";
        $html .= "<script type='text/javascript' src='$script'></script>\n\n";

        if ($froalaPag) {
            $html .= "<script type='text/javascript' src='".$froala."froala_editor.pkgd.min.js'></script>\n";
            $html .= "<script type='text/javascript' src='".$froala."languages/pt_br.js'></script>\n";
            $html .= "<script> $(function() { var editor = new FroalaEditor('#froala-editor') });</script>\n";
            $html .= "<script> $(function() { $('div#froala-editor').froalaEditor({ language: 'pt_br' }) }); </script>\n";
        }

        // $html .= "<script> $.getScript('".$froala."froala_editor.pkgd.min.js', function () { $('div#froala-editor').froalaEditor({ language: 'pt_br' }); }); </script>\n";
        // $html .= "<script> $(function() { $('div#froala-editor').froalaEditor({ language: 'pt_br' }) }); </script>\n";
        
        $html .= "\n";

        $html .= "</body>\n";
        $html .= "</html>";

        echo $html;
    }
}