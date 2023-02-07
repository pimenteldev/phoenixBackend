<?php
    class InventaryUnits{

        // Connection
        private $conn;

        // Table
        private $db_table = "inventary_units";

        // Columns
        public $unit_id;
        public $unit_name;
        public $unit_type;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllUnits(){
            $sqlQuery = "SELECT
                        unit_id,
                        unit_name, 
                        unit_type
                        FROM
                        ". $this->db_table."
                        ORDER BY unit_name ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
    }
?>