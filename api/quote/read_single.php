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

// Get ID of quote to read
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single quote
$quote->get_single();

// Check if quote exists
if ($quote->quote != null) {
    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author_id,
        'category' => $quote->category_id
    );

    // Set response code - 200 OK
    http_response_code(200);

    // Make it JSON format
    echo json_encode($quote_arr);
} else {
    // Set response code - 404 Not found
    http_response_code(404);

    // Tell the user no quote found
    echo json_encode(
        array('message' => 'Quote not found')
    );
}