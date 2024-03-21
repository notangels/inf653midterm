<?php
// Required headers
header("Content-Type: application/json; charset=UTF-8");

// Include database and objects files
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate Database object and connect
$database = new Database();
$db = $database->connect();

// Instantiate Quote object
$quote = new Quote($db);

// Get ID of quote to delete
$data = json_decode(file_get_contents("php://input"));

// Check if ID is present
if (!empty($data->id)) {
    // Set ID property of Quote object
    $quote->id = $data->id;

    // Delete the quote
    if ($quote->delete()) {
        // Quote deleted successfully
        http_response_code(200);
        echo json_encode(array('message' => 'Quote deleted successfully'));
    } else {
        // Failed to delete quote
        http_response_code(503); // Service unavailable
        echo json_encode(array('message' => 'Failed to delete quote'));
    }
} else {
    // Missing required parameter
    http_response_code(400); // Bad request
    echo json_encode(array('message' => 'Missing parameter: id'));
}