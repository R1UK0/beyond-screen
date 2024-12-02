<?php
require '../includes/config.php';
require '../includes/session.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO forum_posts (user_id, content) VALUES (?, ?)");
    $stmt->execute([$user_id, $content]);

    header('Location: ../pages/forum.html');
}
?>
