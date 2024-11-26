<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'ryuko';
$username = 'root';
$password = ''; // Change selon ta config

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect: " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifier = $_POST["identifier"];
    $password = $_POST["password"];

    // Recherche de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR pseudo = ?");
    $stmt->execute([$identifier, $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Enregistrement dans la session
        $_SESSION["user_id"] = $user["id"];
        echo "Login successful!";
    } else {
        echo "Invalid email/pseudo or password.";
    }
}
?>
