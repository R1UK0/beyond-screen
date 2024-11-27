<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ryuko_admin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Calculer les statistiques de la journée
    $total_visits_today = $pdo->query("SELECT COUNT(*) FROM visits WHERE DATE(visit_time) = CURDATE()")->fetchColumn();
    $total_signups_today = $pdo->query("SELECT COUNT(*) FROM users WHERE DATE(signup_date) = CURDATE()")->fetchColumn();

    // Ajouter aux statistiques globales
    $stmt = $pdo->prepare("INSERT INTO stats (date, total_visits, total_signups) VALUES (CURDATE(), ?, ?)");
    $stmt->execute([$total_visits_today, $total_signups_today]);

    // Supprimer les visites de la journée
    $pdo->exec("DELETE FROM visits WHERE DATE(visit_time) = CURDATE()");

    echo "Daily visits reset successfully!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
