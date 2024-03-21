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

// Get categories
$result = $category->read();

// Check if any categories exist
if ($result->rowCount() > 0) {
    // Categories array
    $categories_arr = array();
    $categories_arr['data'] = array();

    // Retrieve category records
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // Format data
        $category_item = array(
            "id" => $id,
            "category" => $category
        );

        // Push to "data"
        array_push($categories_arr['data'], $category_item);
    }

    // Set response code - 200 OK
    http_response_code(200);

    // Show categories data in JSON format
    echo json_encode($categories_arr);
} else {
    // Set response code - 404 Not found
    http_response_code(404);

    // Tell the user no categories found
    echo json_encode(array("message" => "No categories found."));
}