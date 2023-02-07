<?php
    class Role{

        // Connection
        private $conn;

        // Table
        private $db_table = "role";

        // Columns
        public $role_id;
        public $role_name;
        public $role_color;
        public $role_seller;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllRoles(){
            $sqlQuery = "SELECT
                        role_id, 
                        role_name, 
                        role_color
                        FROM
                        ". $this->db_table." 
                        ORDER BY role_name ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAllInnkeepers(){
            $sqlQuery = "SELECT
                        role_id, 
                        role_name, 
                        role_color,
                        role_seller
                        FROM
                        ". $this->db_table."
                        WHERE role_seller = 1 
                        ORDER BY role_name ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleTable(){
            $sqlQuery = "";
            $table_id = $this->table_id;
            if($table_id!==""){
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
            }else{
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
            }
            
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

