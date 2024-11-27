CREATE DATABASE ryuko_admin;

USE ryuko_admin;

-- Table pour les utilisateurs inscrits
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    pseudo VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    signup_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table pour les visites
CREATE TABLE visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(50) NOT NULL,
    visit_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table pour les statistiques
CREATE TABLE stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    total_visits INT NOT NULL,
    total_signups INT NOT NULL
);
