<?php
    $dbHost = 'localhost';
    $dbName = 'task_app';
    $dbUser = 'root';
    $dbPassword = 'zawadi1256';
    $db  = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    require_once __DIR__ . '/../src/Controllers/UserController.php';

    $controller = new  UserController($db);

    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'register':
            $controller->register();
            break;
        case 'listUsers':
            $controller->listUsers();
            break;
        default:
            $controller->showRegistrationForm();
            break;
    }
