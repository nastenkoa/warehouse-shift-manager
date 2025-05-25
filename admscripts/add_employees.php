<?php
$dbFile = __DIR__ . '../src/db.sqlite';
$pdo = new PDO('sqlite:' . $db_path); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$employeeFile = __DIR__ . '/files/employees_add.txt';
        if (file_exists($employeeFile)) {
            $employees = file($employeeFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $stmt = $db->prepare("INSERT INTO employees (name) VALUES (?)");
            foreach($employees as $row)
            {
                $stmt->execute([$row]);
            }
            echo "Employees added successfully.\n</br>";
        } else {
            echo "File with list of employees not found.\n</br>";
        }

?>