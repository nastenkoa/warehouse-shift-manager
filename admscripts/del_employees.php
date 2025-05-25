<?php
$dbFile = __DIR__ . '../src/db.sqlite';
$pdo = new PDO('sqlite:' . $db_path); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$employeeFile = __DIR__ . '/files/employees_del.txt';
        if (file_exists($employeeFile)) {
            $employees = file($employeeFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $stmt = $db->prepare("DELETE FROM employees WHERE name = ?");
            foreach($employees as $row)
            {
                $stmt->execute([$row]);
            }
            echo "Employees have been successfully removed.\n</br>";
        } else {
            echo "The file containing the list of employees was not found.\n</br>";
        }

?>