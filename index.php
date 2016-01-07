<?php

/* CHARGEMENT D'UN FICHIER DE CONFIGURATION */
const PATH_ROOT = __DIR__ . '/';
require 'config/config.php';

 
/* MON SYSTEME DE ROUTING MAISON */
// Je recupere le parametre qui a été re-ecrit dans le htaccess et je le traite
$path  = filter_input(INPUT_GET,'path',FILTER_SANITIZE_STRING);


// cas d'une URL avec ID
if(preg_match('#([a-z]+)#', $path, $pathInfos)) {
    $route = ['template' => $pathInfos[1]];
}elseif('' === $path) {
        $route = ['template' => 'login'];
}else {
    $route = ['template' => '404'];
}

if (!file_exists(PATH_CONTROLERS.$route['template'].".php")) {
    $route = ['template' => '404'];
}else {
    include PATH_CONTROLERS.$route['template'].".php";
}

if (file_exists(PATH_VIEW.$route['template'].".html")) {
    include PATH_VIEW.$route['template'].".html";
}