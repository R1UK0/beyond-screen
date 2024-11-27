<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php"); // Rediriger vers le tableau de bord si déjà connecté
    exit;
}

// Vérification du mot de passe
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"];
    if ($password === "adminaccess#MCMff") {
        $_SESSION['admin_logged_in'] = true; // Démarrer la session de l'administrateur
        header("Location: admin_dashboard.php"); // Rediriger vers le tableau de bord
        exit;
    } else {
        $error = "Mot de passe incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access - Ryuko</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 400px; margin: 0 auto; padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1 { text-align: center; color: #333; }
        form { display: flex; flex-direction: column; }
        label { margin-bottom: 10px; }
        input[type="password"] { padding: 10px; margin-bottom: 20px; font-size: 16px; border: 1px solid #ccc; }
        button { padding: 10px; background-color: #0078d4; color: white; border: none; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #005fa3; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Admin Access</h1>
        <form method="POST">
            <label for="password">Entrez le mot de passe administrateur :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>

</body>
</html>
