<?php
/* Home URL with trailing slash */
const URL_HOME = 'http://localhost/minichat/';

/* DEFINTION DES PATHS */
const PATH_CONFIG = PATH_ROOT . 'config/';
const PATH_MODEL = PATH_ROOT . 'model/';
const PATH_CLASSES = PATH_MODEL . 'classes/';
const PATH_VIEW = PATH_ROOT . 'views/';
const PATH_CONTROLERS = PATH_ROOT . 'controlers/';

/* URL POUR LES ASSETS*/
const URL_VIEWS = URL_HOME . 'views/';
const URL_SCRIPTS = URL_VIEWS . 'scripts/';

/* PARAMETRES DE LA BASE */
const DATABASE_HOST = 'localhost';
const DATABASE_DBNAME = 'minichat';
const DATABASE_USER = 'root';
const DATABASE_PASS = 'openska';

/* CONNEXION A LA BASE */
require PATH_CONFIG.'database.php';

/* INSERTION DES CLASSES */
require PATH_CONFIG.'classes.php';

/* SESSION */
session_start();

 if(isset($_SESSION['userId']) && $_SESSION['userId'] !== 0) {
    $user = new User($database,$_SESSION['userId']);
 }
