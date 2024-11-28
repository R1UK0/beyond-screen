<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to YourHub</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <section class="hero">
            <h1>Welcome to YourHub</h1>
            <p>Your online platform to host, collaborate, and manage your coding projects.</p>
            <a href="register.php" class="btn">Sign Up</a>
            <a href="login.php" class="btn">Log In</a>
        </section>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
