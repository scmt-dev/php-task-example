<?php

$person = [
    'name' => 'John Doe',
    'age' => 30
];

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($person);
        break;
    case 'POST':
        $name = $_POST['name'] ?? null;
        $age = $_POST['age'] ?? null;
        if(!$name) {
            echo json_encode(['error' => 'name is required']);
            exit;
        }
        if(!$age) {
            echo json_encode(['error' => 'age is required']);
            exit;
        }
        echo json_encode(['message' => 'Hello ' . $name]);
        break;
    default:
        echo 'method not allowed';
        break;
}



