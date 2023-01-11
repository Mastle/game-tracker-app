<?php 

class Database {
    //DB params
    private $host = 'localhost';
    private $db_name = 'game_tracker';
    private $username = 'AT';
    private $password = '1022';
    private $conn;
    

    // DB connect
    public function connect(){
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:hosts=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();

        }

        return $this->conn;

    }


    public function read() {
        // Create query
        $query = 'SELECT * FROM users';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
  



 }