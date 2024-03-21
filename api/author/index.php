<?php
// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
}

// Include database and objects files
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database object and connect
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$author = new Author($db);

// Read authors
$result = $author->read();

// Check if any authors found
if ($result) {
    // Authors found
    http_response_code(200);
    echo json_encode($result);
} else {
    // No authors found
    http_response_code(404);
    echo json_encode(array('message' => 'No authors found'));
}