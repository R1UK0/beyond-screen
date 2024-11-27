<?php
session_start();
session_destroy();  // Détruit toutes les variables de session
header("Location: admin.php");  // Redirige l'utilisateur vers la page d'admin
exit;
?>
