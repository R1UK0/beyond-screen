<?php
require '../includes/config.php';
require '../includes/session.php';

requireLogin();

$stmt = $pdo->prepare("SELECT name, description FROM repositories WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$repositories = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['repositories' => $repositories]);
?>
