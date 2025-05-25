<?php
require_once '../autoload.php';
$config = require('../config.php');

$db = new Database($config['db_path']);
$auth = new Auth(new User($db));

if (!$auth->check()) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['q'])) {
    $query = trim($_GET['q']);
    $stmt = $db->query("SELECT name FROM employees WHERE name LIKE ? LIMIT 10",["%$query%"]);
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($results);
}
?>