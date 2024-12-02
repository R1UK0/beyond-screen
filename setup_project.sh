#!/bin/bash

# Nom du projet
PROJECT_NAME="yourhub"

# Chemin du répertoire du projet
PROJECT_DIR="$HOME/$PROJECT_NAME"

# Vérification si le répertoire existe
if [ -d "$PROJECT_DIR" ]; then
  echo "Le projet $PROJECT_NAME existe déjà dans $PROJECT_DIR"
  exit 1
fi

# Création des répertoires
echo "Création des répertoires pour $PROJECT_NAME..."
mkdir -p "$PROJECT_DIR"/{assets/{css,js},includes,handlers,pages,sql}

# Création des fichiers de base
echo "Création des fichiers de base..."
cat > "$PROJECT_DIR/index.php" <<EOL
<?php
header("Location: pages/index.html");
exit;
?>
EOL

cat > "$PROJECT_DIR/assets/css/styles.css" <<EOL
/* Fichier de style principal */
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  color: #333;
  margin: 0;
  padding: 0;
}
header, footer {
  background-color: #333;
  color: white;
  padding: 15px;
  text-align: center;
}
EOL

cat > "$PROJECT_DIR/includes/config.php" <<EOL
<?php
\$host = 'localhost';
\$dbname = '$PROJECT_NAME';
\$username = 'root';
\$password = '';
try {
    \$pdo = new PDO("mysql:host=\$host;dbname=\$dbname", \$username, \$password);
    \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException \$e) {
    die("Erreur de connexion : " . \$e->getMessage());
}
?>
EOL

cat > "$PROJECT_DIR/sql/init.sql" <<EOL
CREATE DATABASE IF NOT EXISTS $PROJECT_NAME;

USE $PROJECT_NAME;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE forum_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(50),
    visit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE repositories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
EOL

echo "Création des pages HTML de base..."
cat > "$PROJECT_DIR/pages/index.html" <<EOL
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YourHub - Welcome</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>YourHub</h1>
        <nav>
            <a href="login.html">Log In</a>
            <a href="register.html">Sign Up</a>
        </nav>
    </header>
    <main>
        <h2>Bienvenue sur YourHub</h2>
        <p>Créez, hébergez, et collaborez sur vos projets de code facilement.</p>
    </main>
    <footer>
        <p>&copy; 2024 YourHub</p>
    </footer>
</body>
</html>
EOL

cat > "$PROJECT_DIR/pages/login.html" <<EOL
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - YourHub</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>YourHub - Log In</h1>
    </header>
    <main>
        <form method="POST" action="../handlers/login_handler.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Log In</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 YourHub</p>
    </footer>
</body>
</html>
EOL

echo "Configuration terminée !"

echo "Instructions :"
echo "1. Déplacez-vous dans le répertoire avec : cd $PROJECT_DIR"
echo "2. Importez la base de données avec : mysql -u root < sql/init.sql"
echo "3. Hébergez le projet localement avec XAMPP/MAMP, ou utilisez un serveur distant."
