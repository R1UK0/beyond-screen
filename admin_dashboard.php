<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin.php");
    exit;
}

// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=ryuko_admin", "root", "");

// Récupération des utilisateurs inscrits
$users = $pdo->query("SELECT email, pseudo, signup_date FROM users")->fetchAll(PDO::FETCH_ASSOC);

// Récupération des visites
$visits_today = $pdo->query("SELECT COUNT(*) as visit_count FROM visits WHERE DATE(visit_time) = CURDATE()")->fetchColumn();

// Récupération des statistiques globales
$total_visits = $pdo->query("SELECT SUM(total_visits) FROM stats")->fetchColumn();
$total_signups = $pdo->query("SELECT SUM(total_signups) FROM stats")->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Total Visitors: <?= $total_visits ?? 0; ?></p>
    <p>Total Signups: <?= $total_signups ?? 0; ?></p>
    <p>Visitors Today: <?= $visits_today ?? 0; ?></p>

    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>Email</th>
            <th>Pseudo</th>
            <th>Signup Date</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td><?= htmlspecialchars($user['pseudo']); ?></td>
            <td><?= htmlspecialchars($user['signup_date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
