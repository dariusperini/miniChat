<?php

 if (!isset($_SESSION['userId']) || $_SESSION['userId'] == 0) {
        header("Location: ".URL_HOME."login");
 }


// SELECTION DES MESSAGES DEJA EN BASE
$chat = new Chat($database, $user->getLastLog());
$tabMessages = $chat->getAllSessionMessages();
            
$lastMessageId = $chat->getLastMessageId();
    


