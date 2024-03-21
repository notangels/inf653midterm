<?php
// Required headers
header("Content-Type: application/json; charset=UTF-8");

// Include database and objects files
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database object and connect
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$author = new Author($db);

// Check if the author ID is provided
if (isset($_GET['id'])) {
    $author->id = $_GET['id'];

    // Read single author
    $result = $author->get_single();

    if ($result) {
        // Author found
        http_response_code(200);
        echo json_encode($result);
    } else {
        // Author not found
        http_response_code(404);
        echo json_encode(array('message' => 'Author not found'));
    }
} else {
    // Missing required parameter 'id'
    http_response_code(400);
    echo json_encode(array('message' => 'Missing parameter: id'));
}