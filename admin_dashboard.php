<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin.php");
    exit;
}

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ryuko_admin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Récupérer les utilisateurs inscrits
$users = $pdo->query("SELECT email, pseudo, signup_date FROM users")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les visites du jour
$visits_today = $pdo->query("SELECT ip_address, visit_time FROM visits WHERE DATE(visit_time) = CURDATE()")->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard - Ryuko</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Statistics</h2>
            <p>Total Visitors: <?= $total_visits ?? 0; ?></p>
            <p>Total Signups: <?= $total_signups ?? 0; ?></p>
            <h3>Today's Visitors: <?= count($visits_today); ?></h3>
        </section>

        <section>
            <h2>Visitors Today</h2>
            <table>
                <tr>
                    <th>IP Address</th>
                    <th>Visit Time</th>
                </tr>
                <?php foreach ($visits_today as $visit): ?>
                <tr>
                    <td><?= htmlspecialchars($visit['ip_address']); ?></td>
                    <td><?= htmlspecialchars($visit['visit_time']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section>
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
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Ryuko Code Editor Platform. All rights reserved.</p>
    </footer>
</body>
</html>
