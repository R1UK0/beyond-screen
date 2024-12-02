<?php
session_start();

// Vérification si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirection si l'utilisateur n'est pas connecté
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../pages/login.html');
        exit;
    }
}
?>
