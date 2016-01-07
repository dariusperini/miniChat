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
require '../../model/classes/Chat.php';

/* SESSION */
session_start();

 if(isset($_SESSION['userId']) && $_SESSION['userId'] !== 0) {
    $user = new User($database,$_SESSION['userId']);
 }


   $inputs = filter_input_array(INPUT_POST,[
        'lastMessageId'         => FILTER_SANITIZE_STRING
    ]);
    
$chat = new Chat($database, $user->getLastLog());
$tabMessages['resultat'] = $chat->getAllMessageAfterMessageId($inputs['lastMessageId']);
$tabMessages['lastMessageId'] = $chat->getLastMessageId();

echo json_encode($tabMessages);
