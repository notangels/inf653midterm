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
$data = json_decode(file_get_contents("php://input"));

// Set ID property of category to be deleted
$category->id = $data->id;

// Delete the category
if ($category->delete()) {
    // Set response code - 200 OK
    http_response_code(200);

    // Tell the user
    echo json_encode(array("message" => "Category was deleted."));
} else {
    // Set response code - 503 Service Unavailable
    http_response_code(503);

    // Tell the user
    echo json_encode(array("message" => "Unable to delete category."));
}