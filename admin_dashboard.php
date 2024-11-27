<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin.php"); // Rediriger vers la page de connexion si non connecté
    exit;
}

// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=ryuko_admin", "root", "");

// Récupérer les utilisateurs inscrits
$users = $pdo->query("SELECT email, pseudo, signup_date FROM users")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les visites du jour
$visits_today = $pdo->query("SELECT COUNT(*) as visit_count FROM visits WHERE DATE(visit_time) = CURDATE()")->fetchColumn();

// Récupérer les statistiques globales
$total_visits = $pdo->query("SELECT COUNT(*) FROM visits")->fetchColumn();
$total_signups = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin - Ryuko</title>
    <style>
        /* Ton style CSS ici */
    </style>
</head>
<body>
    <h1>Tableau de bord Administrateur</h1>
    <p>Total des visiteurs : <?= $total_visits; ?></p>
    <p>Total des inscriptions : <?= $total_signups; ?></p>
    <p>Visites aujourd'hui : <?= $visits_today; ?></p>

    <h2>Utilisateurs inscrits</h2>
    <table>
        <tr>
            <th>Email</th>
            <th>Pseudo</th>
            <th>Date d'inscription</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td><?= htmlspecialchars($user['pseudo']); ?></td>
            <td><?= htmlspecialchars($user['signup_date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="admin_logout.php">Déconnexion</a>
</body>
</html>
