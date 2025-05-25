<?php
require_once '../autoload.php';
$config = require('../config.php');

$db = new Database($config['db_path']);
$auth = new Auth(new User($db));

if (!$auth->check()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $auth->getUserId();
    
    $db->query(
        "INSERT INTO data (user_id, employee_id, department_from_id, department_to_id, time) VALUES (?, ?, ?, ?, ?)",
        [$userId, $_POST['lastname'], $_POST['select1'], $_POST['select2'], $_POST['time']]
    ); 
    
    
    // Write to GoogleTable

    // Web application URL (from Google Apps Script)
    $scriptUrl = $config['google_script_url'];

    // Data to send (an array of arrays, where each row is an array of values to add to the table)
    // Jméno | Čas | Z odd. | Na odd.

    $name = $_POST['lastname'];
    $time = $_POST['time'];
    $dep_from = $db->query("SELECT department_name FROM departments WHERE id = ?", [$_POST['select1']])->fetch(PDO::FETCH_ASSOC)['department_name'];
    $dep_to = $db->query("SELECT department_name FROM departments WHERE id = ?", [$_POST['select2']])->fetch(PDO::FETCH_ASSOC)['department_name'];
    
    $data = [
        [$name, $time, $dep_from, $dep_to]     
    ];

    // Convert data to JSON
    $jsonData = json_encode($data);

    // Send data via POST request
    $options = [
        'http' => [
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => $jsonData
    ]
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($scriptUrl, false, $context);

    if ($result === FALSE) {
        echo "Error while sending data!";
    } else {
        echo "Server response: $result";
    }
    
    // Set a cookie with the message
    setcookie("flash_message", "1", time() + 10, "/");

    // Redirect
    header("Location: ../views/add_data.php");
    exit;
}
?>