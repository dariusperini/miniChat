<?php


// on enleve l'utilisateur de la table des connectés
        $del = 'DELETE FROM connected WHERE user_id='.$_SESSION['userId'];
        $database->exec($del);    

$_SESSION['userId'] = 0;
        
header("Location: ".URL_HOME);