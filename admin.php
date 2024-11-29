<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"];
    if ($password === "adminaccess#MCMff") {
        $_SESSION['admin_logged_in'] = true;

        // Connect to database
        $pdo = new PDO("mysql:host=localhost;dbname=yourhub", "root", "");

        // Fetch statistics
        $totalVisitors = $pdo->query("SELECT COUNT(*) FROM visits")->fetchColumn();
        $totalSignups = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

        // Fetch users
        $stmt = $pdo->query("SELECT email, username, signup_date FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "success" => true,
            "totalVisitors" => $totalVisitors,
            "totalSignups" => $totalSignups,
            "users" => $users
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
