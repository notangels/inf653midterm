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

    // Delete the author
    if ($author->delete()) {
        // Author deleted successfully
        http_response_code(200);
        echo json_encode(array('message' => 'Author deleted successfully'));
    } else {
        // Failed to delete author
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to delete author'));
    }
} else {
    // Missing required parameter 'id'
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing parameter: id'));
}