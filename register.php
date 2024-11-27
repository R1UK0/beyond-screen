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

<?php
// Informations pour se connecter à reCAPTCHA
$secretKey = "6Lf6DosqAAAAAHL_FKQwA725tum17ElfNvkCXoex"; // Remplace par ta clé secrète
$responseKey = $_POST['g-recaptcha-response']; // Récupère la réponse du reCAPTCHA
$userIP = $_SERVER['REMOTE_ADDR']; // Adresse IP de l'utilisateur

// Envoi de la requête au serveur Google
$url = "https://www.google.com/recaptcha/api/siteverify";
$data = [
    'secret' => $secretKey,
    'response' => $responseKey,
    'remoteip' => $userIP,
];

// Utilisation de cURL pour envoyer les données
$options = [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_RETURNTRANSFER => true,
];
$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);

// Analyse de la réponse de Google
$responseData = json_decode($response, true);
if (!$responseData['success']) {
    die("Captcha validation failed. Please try again.");
}

// Si le captcha est validé, continue avec l'inscription
$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ryuko", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR pseudo = ?");
    $stmt->execute([$email, $pseudo]);
    if ($stmt->rowCount() > 0) {
        die("Email or pseudo already exists.");
    }

    // Insérer l'utilisateur
    $stmt = $pdo->prepare("INSERT INTO users (email, pseudo, password) VALUES (?, ?, ?)");
    $stmt->execute([$email, $pseudo, $password]);
    echo "Account created successfully!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
