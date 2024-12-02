<?php include '../includes/session.php'; ?>

<header>
    <h1><a href="index.html">YourHub</a></h1>
    <nav>
        <?php if (isLoggedIn()): ?>
            <a href="dashboard.html">Dashboard</a>
            <a href="profile.html">Profile</a>
            <a href="../handlers/logout_handler.php">Log Out</a>
        <?php else: ?>
            <a href="login.html">Log In</a>
            <a href="register.html">Sign Up</a>
        <?php endif; ?>
    </nav>
</header>
