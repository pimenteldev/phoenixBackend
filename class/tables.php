<?php
    class Tables{

        // Connection
        private $conn;

        // Table
        private $db_table = "tables";

        // Columns
        public $table_id;
        public $table_name;
        public $table_status;
        public $table_active;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllTables(){
            $sqlQuery = "SELECT
                        table_id, 
                        table_name, 
                        table_status,
                        table_active
                        FROM
                        ". $this->db_table." 
                        ORDER BY table_name ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleTableByName(){
            $sqlQuery = "SELECT
                        table_id, 
                        table_name, 
                        table_status,
                        table_active
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        table_name = :table_name ";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":table_name", $this->table_name);

            $stmt->execute();
            return $stmt;
        }

        public function getSingleTableById(){
            $sqlQuery = "SELECT
                        table_id, 
                        table_name, 
                        table_status,
                        table_active
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        table_id = :table_id ";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":table_id", $this->table_id);

            $stmt->execute();
            return $stmt;
        }

        public function createTable(){
            $sqlQuery = "INSERT INTO 
                        ". $this->db_table." (
                        table_name, 
                        table_status )
                        VALUES (
                        :table_name, 
                        :table_status )";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->table_name=htmlspecialchars(strip_tags($this->table_name));
            $this->table_status=htmlspecialchars(strip_tags($this->table_status));

            $stmt->bindParam(":table_name", $this->table_name);
            $stmt->bindParam(":table_status", $this->table_status);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateTable(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        table_name = :table_name, 
                        table_status = :table_status
                        WHERE 
                        table_id = :table_id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->table_id=htmlspecialchars(strip_tags($this->table_id));
            $this->table_name=htmlspecialchars(strip_tags($this->table_name));
            $this->table_status=htmlspecialchars(strip_tags($this->table_status));

            $stmt->bindParam(":table_id", $this->table_id);
            $stmt->bindParam(":table_name", $this->table_name);
            $stmt->bindParam(":table_status", $this->table_status);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateTableWithNewOrder(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        table_active = 1
                        WHERE 
                        table_id = :table_id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->table_id=htmlspecialchars(strip_tags($this->table_id));

            $stmt->bindParam(":table_id", $this->table_id);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateTableAfterCreateFacture(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        table_active = 0
                        WHERE 
                        table_id = :table_id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->table_id=htmlspecialchars(strip_tags($this->table_id));

            $stmt->bindParam(":table_id", $this->table_id);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        

        public function removeTable(){
            $sqlQuery = "DELETE FROM
                        ". $this->db_table ."
                        WHERE 
                        table_id = :table_id";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->table_id=htmlspecialchars(strip_tags($this->table_id));
            $stmt->bindParam(":table_id", $this->table_id);
            
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

