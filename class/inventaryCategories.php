<?php
    class InventaryCategories{

        // Connection
        private $conn;

        // Table
        private $db_table = "inventary_categories";

        // Columns
        public $category_id;
        public $category_name;
        public $category_color;
        public $category_ingredient;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllInventaryCategoriesIngredient(){
            $sqlQuery = "SELECT
                        category_id,
                        category_name, 
                        category_color, 
                        category_ingredient
                        FROM
                        ". $this->db_table."
                        WHERE category_ingredient = 1
                        ORDER BY category_name ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAllInventaryCategories(){
            $sqlQuery = "SELECT
                        category_id,
                        category_name, 
                        category_color, 
                        category_ingredient
                        FROM
                        ". $this->db_table."
                        ORDER BY category_name ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        
    }
?>