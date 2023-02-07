<?php
    class InventaryOperations{

        // Connection
        private $conn;

        // Table
        private $db_table = "inventary_operations";

        // Columns
        public $operation_id;
        public $operation_type;
        public $operation_item_id;
        public $operation_category;
        public $operation_unit;
        public $operation_count;
        public $operation_date;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllInventaryOperations(){
            $sqlQuery = "SELECT
                        operation_id,
                        operation_type, 
                        operation_item_id,
                        operation_category, 
                        operation_unit,
                        operation_count, 
                        operation_date
                        FROM
                        ". $this->db_table."
                        ORDER BY operation_id ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createInventaryOperation(){
            $today = date('Y/m/d H:i:s');
            $sqlQuery = "INSERT INTO 
                        ". $this->db_table." (
                        operation_type, 
                        operation_item_id,
                        operation_category,
                        operation_unit,
                        operation_count,
                        operation_date )
                        VALUES (
                        :operation_type, 
                        :operation_item_id,
                        :operation_category, 
                        :operation_unit,
                        :operation_count, 
                        :operation_date
                        )";

            $stmt = $this->conn->prepare($sqlQuery);
            
            $this->operation_type=htmlspecialchars(strip_tags($this->operation_type));
            $this->operation_item_id=htmlspecialchars(strip_tags($this->operation_item_id));
            $this->operation_category=htmlspecialchars(strip_tags($this->operation_category));
            $this->operation_unit=htmlspecialchars(strip_tags($this->operation_unit));
            $this->operation_count=htmlspecialchars(strip_tags($this->operation_count));
            
            $stmt->bindParam(":operation_type", $this->operation_type);
            $stmt->bindParam(":operation_item_id", $this->operation_item_id);
            $stmt->bindParam(":operation_category", $this->operation_category);
            $stmt->bindParam(":operation_unit", $this->operation_unit);
            $stmt->bindParam(":operation_count", $this->operation_count);
            $stmt->bindParam(":operation_date", $today);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }
    }
?>