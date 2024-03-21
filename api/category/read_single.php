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

// Get category id from URL
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read single category
$category->read_single();

// Check if category exists
if ($category->category != null) {
    // Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    // Set response code - 200 OK
    http_response_code(200);

    // Make it JSON format
    echo json_encode($category_arr);
} else {
    // Set response code - 404 Not found
    http_response_code(404);

    // Tell the user no category found
    echo json_encode(array("message" => "Category not found."));
}