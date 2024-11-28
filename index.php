<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
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
    <header>
        <h1><a href="index.php">YourHub</a></h1>
        <nav>
            <a href="login.php" class="btn">Log In</a>
            <a href="register.php" class="btn">Sign Up</a>
        </nav>
    </header>

    <main class="landing">
        <section class="hero">
            <h2>Build, Host, and Share Your Code</h2>
            <p>The best place to collaborate and showcase your coding projects.</p>
            <a href="register.php" class="btn large">Get Started</a>
        </section>

        <section class="features">
            <div class="feature">
                <h3>Create Repositories</h3>
                <p>Organize your code projects, track changes, and share with others.</p>
            </div>
            <div class="feature">
                <h3>Collaborate with Teams</h3>
                <p>Work together on code, pull requests, and project management.</p>
            </div>
            <div class="feature">
                <h3>Get Insights</h3>
                <p>Analyze your code contributions and repository statistics.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 YourHub | <a href="admin.php">Admin Access</a></p>
    </footer>
</body>
</html>
