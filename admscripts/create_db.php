<?php
$dbFile = '../db/db.sqlite';
$initSqlFile = __DIR__ . '/init.sql';
$adminLogin = 'admin';
$adminPassword = 'admin123';

try {
    if (!file_exists($dbFile)) {
        $db = new PDO('sqlite:' . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Database 'db.sqlite' successfully created.\n</br>";

        if (file_exists($initSqlFile)) {
            $sql = file_get_contents($initSqlFile);
            $db->exec($sql);
            echo "File 'init.sql' executed successfully. Tables created.\n</br>";
        } else {
            echo "Error: File 'init.sql' not found.\n</br>";
            exit;
        }
        
        $hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (login, password) VALUES (:login, :password)");
        $stmt->execute([':login' => $adminLogin, ':password' => $hashedPassword]);
        echo "User 'admin' successfully added with login'{$adminLogin}'.\n</br>";

        $departmentsFile = __DIR__ . '/files/departments_add.txt';
        if (file_exists($departmentsFile)) {
            $departments = file($departmentsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $stmt = $db->prepare("INSERT INTO departments (department_name) VALUES (?)");
            foreach($departments as $row)
            {
                $stmt->execute([$row]);
            }
            echo "Departments added successfully.\n</br>";
        } else {
            echo "The file containing the list of departments was not found.\n</br>";
        }

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
            echo "The file containing the list of employees was not found.\n</br>";
        }
    } else {
        echo "Database file 'db.sqlite' already exists. Nothing done.\n";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n</br>";
    exit;
}
?>