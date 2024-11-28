<?php
require '../includes/config.php'; // Configuration DB
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Cryptage du mot de passe

    // Vérification des doublons
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);

    if ($stmt->rowCount() > 0) {
        die("Email or username already exists!");
    }

    // Insérer l'utilisateur
    $stmt = $pdo->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $stmt->execute([$email, $username, $password]);

    // Enregistrer dans la session et rediriger
    $_SESSION['user_id'] = $pdo->lastInsertId();
    header('Location: ../pages/dashboard.php');
}
