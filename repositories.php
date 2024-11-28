<?php
require '../includes/config.php';
session_start();

$user_id = $_SESSION['user_id'];

// Obtenir la liste des dépôts de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM repositories WHERE user_id = ?");
$stmt->execute([$user_id]);
$repositories = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($repositories);
