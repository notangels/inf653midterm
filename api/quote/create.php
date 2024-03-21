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

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if the required fields are present in the received data
if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    // Set the properties of the Quote object
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    // Create the quote
    if ($quote->create()) {
        // Quote created successfully
        http_response_code(201); // Created
        echo json_encode(array('message' => 'Quote created successfully'));
    } else {
        // Failed to create quote
        http_response_code(503); // Service unavailable
        echo json_encode(array('message' => 'Failed to create quote'));
    }
} else {
    // Missing required parameters
    http_response_code(400); // Bad request
    echo json_encode(array('message' => 'Missing required parameters'));
}