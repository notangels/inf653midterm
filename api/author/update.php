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

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if the required fields are present in the received data
if (!empty($data->id) && !empty($data->name)) {
    // Set the properties of the Author object
    $author->id = $data->id;
    $author->name = $data->name;

    // Update the author
    if ($author->update()) {
        // Author updated successfully
        http_response_code(200);
        echo json_encode(array('message' => 'Author updated successfully'));
    } else {
        // Failed to update author
        http_response_code(503); // Service unavailable
        echo json_encode(array('message' => 'Failed to update author'));
    }
} else {
    // Missing required parameters
    http_response_code(400); // Bad request
    echo json_encode(array('message' => 'Missing required parameters'));
}