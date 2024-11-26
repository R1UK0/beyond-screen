<?php
session_start();  // Démarre la session
session_destroy();  // Détruit toutes les variables de session
header("Location: index.html");  // Redirige l'utilisateur vers la page d'accueil
exit;
?>
