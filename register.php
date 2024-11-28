<?php
session_start();
if ($_server["REQUEST_METHOD"] == "POST"){
  $email=$_POST['email'];
  $username=$_POST['username'];
  $password=password_hash($_POST['password'], PASSWORD_BCRYPT);

  $pdo=new PDO("mysql:host=localhost;dbname=yourhub", "root","");
  $stmt=$pdo->prepare("INSERT INTO users (email, username, password) VALUES(?,?,?)");
  $stmt->execute([$email, $username, $password]);

  $_SESSION['user_id']=$pdo->lastInsertId();
  header("Location: dashboard;php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sing Up</title>
  <link rel="stylesheet" href"assets/css/style.css">
</head>

<body>
  <?php include 'includes/header.php';?>
  <main>
    <form method="POST" class="form-container">
      <h2>Create an Account</h2>
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <label for="username">Username:</label>
      <input type="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <button type="submit" class="btn">Let's Go!</button>
    </form>
  </main>
  <?php include 'includes/footer.php';?>
</body>
</html>
