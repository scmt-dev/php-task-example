<?php
require_once 'db.php';
$method = $_SERVER['REQUEST_METHOD'];
header('Content-Type: application/json');

switch ($method) {
    case 'GET': // get data from database
        $sql = "SELECT * FROM products";
        $result = $db->query($sql);
        $products = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($products);
        break;
    case 'POST': // insert data to database
        $name = $_POST['name'] ?? null;
        if(!$name) {
            // send code 400
            http_response_code(400);
            echo json_encode([
                'message' => 'product name is required',
            ]);
            exit;
        }
        break;
    case 'PUT': // update data to database
        break;
    case 'DELETE': // delete data from database
        $sql = "DELETE FROM products WHERE id = ?";
        break;
    default:
        echo 'method not allowed';
        break;
}