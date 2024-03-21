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

// Check if the required field 'id' is present in the received data
if (!empty($data->id)) {
    // Set the 'id' property of the Category object
    $category->id = $data->id;

    // Set the 'category' property if provided
    if (!empty($data->category)) {
        $category->category = $data->category;
    }

    // Update the category
    if ($category->update()) {
        // Category updated successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Category updated successfully'));
    } else {
        // Failed to update category
        http_response_code(503); // Service Unavailable
        echo json_encode(array('message' => 'Failed to update category'));
    }
} else {
    // Missing required parameter 'id'
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing parameter: id'));
}