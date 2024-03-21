<?php

class Category {
    // Database connection and table name
    private $conn;
    private $table_name = "categories";

    // Object properties
    public $id;
    public $category;
    public $created_at;

    // Constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // Read all categories
    function read(){
        // Select all query
        $query = "SELECT id, category FROM " . $this->table_name . " ORDER BY id";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Read single category
    function read_single(){
        // Select single query
        $query = "SELECT id, category FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare( $query );

        // Bind id of category to be read
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->id = $row['id'];
        $this->category = $row['category'];
    }

    // Create category
    function create(){
        // Insert query
        $query = "INSERT INTO " . $this->table_name . " SET category = :category";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));

        // Bind values
        $stmt->bindParam(':category', $this->category);

        // Execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    // Delete category
    function delete(){
        // Delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind id parameter
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    // Update category
    function update(){
        // Update query
        $query = "UPDATE " . $this->table_name . " SET category = :category WHERE id = :id";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

}