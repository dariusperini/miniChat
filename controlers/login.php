<?php

if(!empty($_POST)) {

    // Filtre les données entrantes contre les attaques XSS
    $inputs = filter_input_array(INPUT_POST,[
        'email'         => FILTER_SANITIZE_STRING,
        'pass'      => FILTER_SANITIZE_STRING
    ]);

    if (empty($inputs['email'])) {
        $tabErrors[] = "L'email est vide.";
    }

    if (empty($inputs['pass'])) {
        $tabErrors[] = "Le mot depasse est vide.";
    }
    
    if(empty($tabErrors)) {
        $user = new User($database);
        $user->login($inputs['email'],$inputs['pass']);
        
        if ($user->getId()) {
            $_SESSION['userId'] = $user->getId();
            header("Location: chat.php");
        }
        else {
            $tabErrors[] = "Erreur de connexion";
        }
    }

    
}
