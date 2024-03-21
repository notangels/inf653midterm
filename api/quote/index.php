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
include_once '../../models/Quote.php';

// Instantiate Database object and connect
$database = new Database();
$db = $database->connect();

// Instantiate Quote object
$quote = new Quote($db);

// Get quotes
$result = $quote->read();

// Check if any quotes exist
if ($result->rowCount() > 0) {
    // Quotes array
    $quotes_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        );

        array_push($quotes_arr, $quote_item);
    }

    // Set response code - 200 OK
    http_response_code(200);

    // Show quotes data in JSON format
    echo json_encode($quotes_arr);
} else {
    // Set response code - 404 Not found
    http_response_code(404);

    // Tell the user no quotes found
    echo json_encode(
        array('message' => 'No quotes found')
    );
}