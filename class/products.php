<?php
    class Products{

        // Connection
        private $conn;

        // Table
        private $db_table = "products";

        // Columns
        public $product_id;
        public $product_name;
        public $product_description;
        public $product_base_price;
        public $product_category;
        public $product_items;
        public $product_photo;
        public $product_photo_thumb;
        public $product_status;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllProducts(){
            $sqlQuery = "SELECT
                        product_id, 
                        product_name, 
                        product_description, 
                        product_base_price, 
                        product_category, 
                        product_items, 
                        product_photo, 
                        product_photo_thumb, 
                        product_status
                        FROM
                        ". $this->db_table." 
                        ORDER BY product_category ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleProductById(){
            $sqlQuery = "SELECT
                        product_id, 
                        product_name, 
                        product_description, 
                        product_base_price, 
                        product_category, 
                        product_items, 
                        product_photo, 
                        product_photo_thumb, 
                        product_status
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        product_id = :product_id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->execute();
            return $stmt;

        }

        public function getSingleProductByIDAndName(){
            $sqlQuery = "SELECT
                        product_id, 
                        product_name, 
                        product_description, 
                        product_base_price, 
                        product_category, 
                        product_items, 
                        product_photo, 
                        product_photo_thumb, 
                        product_status
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        product_id = :product_id 
                        OR 
                        product_name = :product_name ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":product_name", $this->product_name);
            $stmt->execute();
            return $stmt;

        }

        public function createProduct(){
            $sqlQuery = "INSERT INTO 
                        ". $this->db_table." (
                        product_id, 
                        product_name, 
                        product_description, 
                        product_base_price, 
                        product_category, 
                        product_items, 
                        product_photo, 
                        product_photo_thumb )
                        VALUES (
                        :product_id, 
                        :product_name, 
                        :product_description, 
                        :product_base_price, 
                        :product_category, 
                        :product_items, 
                        :product_photo, 
                        :product_photo_thumb )";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->product_name=htmlspecialchars(strip_tags($this->product_name));
            $this->product_description=htmlspecialchars(strip_tags($this->product_description));
            $this->product_base_price=htmlspecialchars(strip_tags($this->product_base_price));
            $this->product_category=htmlspecialchars(strip_tags($this->product_category));
            $this->product_photo=htmlspecialchars(strip_tags($this->product_photo));
            $this->product_photo_thumb=htmlspecialchars(strip_tags($this->product_photo_thumb));

            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":product_name", $this->product_name);
            $stmt->bindParam(":product_description", $this->product_description);
            $stmt->bindParam(":product_base_price", $this->product_base_price);
            $stmt->bindParam(":product_category", $this->product_category);
            $stmt->bindParam(":product_items", $this->product_items);
            $stmt->bindParam(":product_photo", $this->product_photo);
            $stmt->bindParam(":product_photo_thumb", $this->product_photo_thumb);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateProduct(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        product_name = :product_name, 
                        product_description = :product_description, 
                        product_base_price = :product_base_price,
                        product_category = :product_category,
                        product_items = :product_items, 
                        product_photo = :product_photo, 
                        product_photo_thumb = :product_photo_thumb,
                        product_status = :product_status
                        WHERE 
                        product_id = :product_id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->product_name=htmlspecialchars(strip_tags($this->product_name));
            $this->product_description=htmlspecialchars(strip_tags($this->product_description));
            $this->product_base_price=htmlspecialchars(strip_tags($this->product_base_price));
            $this->product_category=htmlspecialchars(strip_tags($this->product_category));
            $this->product_photo=htmlspecialchars(strip_tags($this->product_photo));
            $this->product_photo_thumb=htmlspecialchars(strip_tags($this->product_photo_thumb));
            $this->product_status=htmlspecialchars(strip_tags($this->product_status));

            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":product_name", $this->product_name);
            $stmt->bindParam(":product_description", $this->product_description);
            $stmt->bindParam(":product_base_price", $this->product_base_price);
            $stmt->bindParam(":product_category", $this->product_category);
            $stmt->bindParam(":product_items", $this->product_items);
            $stmt->bindParam(":product_photo", $this->product_photo);
            $stmt->bindParam(":product_photo_thumb", $this->product_photo_thumb);
            $stmt->bindParam(":product_status", $this->product_status);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function removeProduct(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $stmt->bindParam(":product_id", $this->product_id);
            
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

