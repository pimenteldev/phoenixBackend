<?php
    class Categories{

        // Connection
        private $conn;

        // Table
        private $db_table = "categories";

        // Columns
        public $category_id;
        public $category_name;
        public $category_color;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllCategories(){
            $sqlQuery = "SELECT
                        category_id, 
                        category_name, 
                        category_color
                        FROM
                        ". $this->db_table." 
                        ORDER BY category_name ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
    }
?>