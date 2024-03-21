<?php 

class Quote {
    // Database connection and table name
    private $conn;
    private $table_name = "quotes";

    // Object properties
    public $id;
    public $quote;
    public $author_id;
    public $category_id;
    public $created_at;

    // Constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // Get single quote by ID
    function get_single(){
        // Select single query
        $query = "SELECT id, quote, author_id, category_id FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare( $query );

        // Bind id of quote to be read
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author_id = $row['author_id'];
        $this->category_id = $row['category_id'];

        return $row;
    }

    // Get all quotes
    function get_all(){
        // Select all query
        $query = "SELECT id, quote, author_id, category_id FROM " . $this->table_name . " ORDER BY id";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        // Get retrieved rows
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Create quote
    function create(){
        // Insert query
        $query = "INSERT INTO " . $this->table_name . " SET quote = :quote, author_id = :author_id, category_id = :category_id";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind values
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // Delete quote
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
    function read(){
        // Select all query
        $query = "SELECT id, quote, author_id, category_id FROM " . $this->table_name . " ORDER BY id";
    
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // Execute query
        $stmt->execute();
    
        // Get retrieved rows
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }

    // Update quote
    function update(){
        // Update query
        $query = "UPDATE " . $this->table_name . " SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}