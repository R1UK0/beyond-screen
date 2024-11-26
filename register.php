<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'ryuko';
$username = 'root';
$password = ''; // Change selon ta config

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect: " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pseudo = $_POST["pseudo"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Vérification si l'email ou le pseudo existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR pseudo = ?");
    $stmt->execute([$email, $pseudo]);
    if ($stmt->rowCount() > 0) {
        echo "Email or Pseudo already exists.";
        exit;
    }

    // Insérer l'utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO users (email, pseudo, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$email, $pseudo, $password])) {
        echo "Account created successfully!";
    } else {
        echo "Error occurred while creating account.";
    }
}
?>
