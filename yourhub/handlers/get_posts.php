<?php
require '../includes/config.php';

$stmt = $pdo->query("SELECT posts.id, posts.title, posts.content, posts.created_at, users.username 
                     FROM posts 
                     JOIN users ON posts.user_id = users.id
                     ORDER BY posts.created_at DESC");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
