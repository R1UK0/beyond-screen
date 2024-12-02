<?php
session_start();
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $subdomain = $_POST['subdomain'];

    $stmt = $pdo->prepare("INSERT INTO subdomains (user_id, subdomain) VALUES (?, ?)");
    $stmt->execute([$user_id, $subdomain]);

    header("Location: ../pages/dashboard.html");
}
?>
