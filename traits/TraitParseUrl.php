<?php

namespace Traits;

trait TraitParseUrl{

    #Cria um array com a url digitada pelo usuário
    public static function parseUrl($par = null) {
        $url = explode("/", rtrim($_GET['url']));
        return ($par == null) ? $url : $url[$par];
    }
}