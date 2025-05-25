<?php
require_once '../autoload.php';
$config = require('../config.php');

$db = new Database($config['db_path']);
$user = new User($db);
$auth = new Auth($user);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($auth->login($login, $password)) {
        header('Location: ../views/add_data.php');
        exit;
    } else {
        $_SESSION['error_message'] = 'Invalid credentials';
        header("Location: ../views/login.php");
        exit;
    }
}
?>