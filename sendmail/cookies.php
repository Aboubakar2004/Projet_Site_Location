<?php
session_start();

// Après une connexion réussie

$_SESSION['username'];
setcookie('session_id', session_id(), time() + 120 , '/');

if (isset($_COOKIE['session_id']) && !empty($_COOKIE['session_id'])) {
    
    // Récupère les informations de session
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    
} else {
    // L'utilisateur n'est pas connecté
    //on le rédirige vers la page de connexion
    header("Location: ../sendmail/index.php");
}


