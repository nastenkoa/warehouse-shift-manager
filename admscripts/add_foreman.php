<?php
$dbFile = __DIR__ . '../src/db.sqlite';
$pdo = new PDO('sqlite:' . $db_path); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$foremanLogin = 'admin';
$foremanPassword = 'admin123';

$hashedPassword = password_hash($foremanPassword, PASSWORD_DEFAULT);
$stmt = $db->prepare("INSERT INTO users (login, password) VALUES (:login, :password)");
$stmt->execute([':login' => $foremanLogin, ':password' => $hashedPassword]);
echo "User successfully added with login '{$foremanLogin}'.\n</br>";

?>