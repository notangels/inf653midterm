<?php
class Author {
    // Properties
    private $conn;
    public $id;
    public $name;
    public $created_at;

    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all authors
    public function get_all() {
        // Query to fetch all authors
        $query = "SELECT * FROM authors";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single author by ID
    public function get_single() {
        // Query to fetch single author
        $query = "SELECT * FROM authors WHERE id = ?";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID parameter
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Check if author exists
        if ($stmt->rowCount() > 0) {
            // Retrieve author details
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->name = $row['name'];
            $this->created_at = $row['created_at'];

            return array(
                "id" => $this->id,
                "name" => $this->name,
                "created_at" => $this->created_at
            );
        } else {
            return null;
        }
    }

    // Create author
    public function create() {
        // Query to insert new author
        $query = "INSERT INTO authors (name) VALUES (:name)";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind parameters
        $stmt->bindParam(':name', $this->name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
     // Delete author by ID
    public function delete() {
        // Query to delete author
        $query = "DELETE FROM authors WHERE id = :id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID parameter
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Read all authors
    public function read() {
    // Query to read all authors
    $query = "SELECT * FROM authors";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();
    return $stmt;
    }

     // Update author
    public function update() {
        // Query to update author
        $query = "UPDATE authors SET name = :name WHERE id = :id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



}
