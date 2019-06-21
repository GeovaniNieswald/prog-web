<?php

$pastaInterna = "prog-web/";
$barra = (substr($_SERVER['DOCUMENT_ROOT'], -1) == '/') ? '' : '/';

# Caminhos absolutos
define('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");
define('DIRREQ', "{$_SERVER['DOCUMENT_ROOT']}{$barra}{$pastaInterna}");

# Atalhos
define('DIRIMG', DIRPAGE.'recursos/imagens/');
define('DIRCSS', DIRPAGE.'recursos/css/');
define('DIRICONE', DIRPAGE.'recursos/icones/');
define('DIRJS', DIRPAGE.'recursos/js/');
define('DIRLIN', DIRPAGE.'recursos/linguagens/');
define('DIRTEMA', DIRPAGE.'recursos/temas/');

# Dados de acesso ao Banco de Dados
define('HOST', "localhost");
define('DB', "poligno_news");
define('USER', "root");
define('PASS', "Gy9=(.h");

# Informações do servidor de email
define("HOSTMAIL", "smtp.gmail.com");
define("USERMAIL", "");
define("PASSMAIL", "");
define("PORTMAIL", 465);

# Outras informações
define('DOMAIN', $_SERVER["HTTP_HOST"]);