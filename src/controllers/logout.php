<?php
require_once '../autoload.php';
$config = require('../config.php');

$auth = new Auth(new User(new Database($config['db_path'])));
$auth->logout();
header('Location: ../views/login.php');
?>