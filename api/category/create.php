<?php
// Required headers
header("Content-Type: application/json; charset=UTF-8");

// Include database and object files
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database object and connect
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if the required field 'category' is present in the received data
if (!empty($data->category)) {
    // Set the 'category' property of the Category object
    $category->category = $data->category;

    // Create the category
    if ($category->create()) {
        // Category created successfully
        http_response_code(201); // Created
        echo json_encode(array('message' => 'Category created successfully'));
    } else {
        // Failed to create category
        http_response_code(503); // Service Unavailable
        echo json_encode(array('message' => 'Failed to create category'));
    }
} else {
    // Missing required parameter 'category'
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing parameter: category'));
}