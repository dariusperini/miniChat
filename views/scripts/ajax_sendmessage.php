<?php

/* PARAMETRES DE LA BASE */
const DATABASE_HOST = 'localhost';
const DATABASE_DBNAME = 'minichat';
const DATABASE_USER = 'root';
const DATABASE_PASS = 'openska';

/* CONNEXION A LA BASE */
require '../../config/database.php';

/* INSERTION DES CLASSES */
require '../../model/classes/User.php';
require '../../model/classes/ChatMessage.php';

/* SESSION */
session_start();

 if(isset($_SESSION['userId']) && $_SESSION['userId'] !== 0) {
    $user = new User($database,$_SESSION['userId']);
 }

 // Variables pour tester en GET
 // ?message=TEST&userId=1
 
 // Si un message est envoyé
if(!empty($_POST)) {
    // Filtre les données entrantes contre les attaques XSS
    $inputs = filter_input_array(INPUT_POST,[
        'message'         => FILTER_SANITIZE_STRING,
        'userId'         => FILTER_SANITIZE_STRING
    ]);

    $message = new ChatMessage($inputs['message'],$user->getId(),$database);
    
    $message->insertMessageInDatabase();
    
 
}
