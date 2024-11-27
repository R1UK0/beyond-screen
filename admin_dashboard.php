<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin.php"); // Redirige si l'utilisateur n'est pas connecté
    exit;
}

// Connexion à la base de données (ajuste les informations de connexion)
$pdo = new PDO("mysql:host=localhost;dbname=ryuko_admin", "root", "");

// Récupération des utilisateurs inscrits
$users = $pdo->query("SELECT email, pseudo, signup_date FROM users")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les visites du jour
$visits_today = $pdo->query("SELECT COUNT(*) as visit_count FROM visits WHERE DATE(visit_time) = CURDATE()")->fetchColumn();

// Récupérer les statistiques globales
$total_visits = $pdo->query("SELECT COUNT(*) FROM visits")->fetchColumn();
$total_signups = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Ajouter un peu de style pour rendre le tableau plus joli */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; }
        th { background-color: #333; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <p>Total Visitors: <?= $total_visits; ?></p>
    <p>Total Signups: <?= $total_signups; ?></p>
    <p>Visitors Today: <?= $visits_today; ?></p>

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
