<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php");
    exit;
}

// Vérification du mot de passe
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"];
    if ($password === "adminaccess#MCMff") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php"); // Rediriger vers le tableau de bord
        exit;
    } else {
        $error = "Invalid password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Access</h1>
    <form method="POST">
        <label for="password">Enter Admin Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
