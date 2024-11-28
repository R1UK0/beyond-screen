$stmt = $pdo->prepare("INSERT INTO admin_log (email, username) VALUES (?, ?)");
$stmt->execute([$email, $username]);
