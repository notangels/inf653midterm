<?php
  // Required headers
  header("Content-Type: application/json; charset=UTF-8"); 

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Author object
  $author = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Check if the required field 'name' is present in the received data
  if (!empty($data->name)) {
  // Set the 'name' property of the Author object
  $author->name = $data->name;

  // Create the author
  if ($author->create()) {
      // Author created successfully
      echo json_encode(array('message' => 'Author created successfully'));
  } else {
      // Failed to create author
      echo json_encode(array('message' => 'Failed to create author'));
  }
} else {
  // Missing required parameter 'name'
  http_response_code(400); // Bad Request
  echo json_encode(array('message' => 'Missing parameter: name'));
}