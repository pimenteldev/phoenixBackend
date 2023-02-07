<?php
    class Inventary{

        // Connection
        private $conn;

        // Table
        private $db_table = "inventary";
        private $db_tableInnerJoin = "inventary_categories";

        // Columns
        public $item_id;
        public $item_name;
        public $item_category;
        public $item_uni_metric;
        public $item_count;
        public $item_create;
        public $item_status;
        
        public $list_inventary;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllItemsIngredients(){
            $sqlQuery = "SELECT
                        item_id, 
                        item_name, 
                        item_category, 
                        item_uni_metric, 
                        item_count, 
                        item_create, 
                        item_status
                        FROM
                        ". $this->db_table." AS i
                        INNER JOIN ". $this->db_tableInnerJoin." AS ic
                        ON i.item_category=ic.category_id 
                        AND ic.category_ingredient=1
                        ORDER BY item_category ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleInventaryItemByName(){
            $sqlQuery = "SELECT
                        item_name
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        item_name = :item_name ";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":item_name", $this->item_name);

            $stmt->execute();
            return $stmt;
        }

        public function getSingleInventaryItemById(){
            $sqlQuery = "SELECT
                        item_id,
                        item_count
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        item_id = :item_id ";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":item_id", $this->item_id);

            $stmt->execute();
            return $stmt;
        }
        
        public function createItemInInventary(){
            $today = date('Y/m/d H:i:s');
            $sqlQuery = "INSERT INTO 
                        ". $this->db_table." (
                        item_name, 
                        item_category,
                        item_uni_metric,
                        item_create )
                        VALUES (
                        :item_name, 
                        :item_category,
                        :item_uni_metric, 
                        :item_create
                        )";

            $stmt = $this->conn->prepare($sqlQuery);
            
            $this->item_name=htmlspecialchars(strip_tags($this->item_name));
            $this->item_category=htmlspecialchars(strip_tags($this->item_category));
            $this->item_uni_metric=htmlspecialchars(strip_tags($this->item_uni_metric));

            $stmt->bindParam(":item_name", $this->item_name);
            $stmt->bindParam(":item_category", $this->item_category);
            $stmt->bindParam(":item_uni_metric", $this->item_uni_metric);
            $stmt->bindParam(":item_create", $today);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateItemInInventary(){
            $today = date('Y/m/d H:i:s');
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        item_name = :item_name, 
                        item_category = :item_category, 
                        item_uni_metric = :item_uni_metric,
                        item_create = :item_create,
                        item_status = :item_status
                        WHERE 
                        item_id = :item_id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->item_id=htmlspecialchars(strip_tags($this->item_id));
            $this->item_name=htmlspecialchars(strip_tags($this->item_name));
            $this->item_category=htmlspecialchars(strip_tags($this->item_category));
            $this->item_uni_metric=htmlspecialchars(strip_tags($this->item_uni_metric));
            $this->item_status=htmlspecialchars(strip_tags($this->item_status));

            $stmt->bindParam(":item_id", $this->item_id);
            $stmt->bindParam(":item_name", $this->item_name);
            $stmt->bindParam(":item_category", $this->item_category);
            $stmt->bindParam(":item_uni_metric", $this->item_uni_metric);
            $stmt->bindParam(":item_create", $today);
            $stmt->bindParam(":item_status", $this->item_status);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateCountItemInInventary(){
            $today = date('Y/m/d H:i:s');
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        item_count = :item_count,
                        item_create = :item_create
                        WHERE 
                        item_id = :item_id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->item_id=htmlspecialchars(strip_tags($this->item_id));
            $this->item_count=htmlspecialchars(strip_tags($this->item_count));

            $stmt->bindParam(":item_id", $this->item_id);
            $stmt->bindParam(":item_count", $this->item_count);
            $stmt->bindParam(":item_create", $today);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        
        public function removeItemInInventary(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE item_id = :item_id";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->item_id=htmlspecialchars(strip_tags($this->item_id));
            $stmt->bindParam(":item_id", $this->item_id);
            
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function discountItemsInFacture(){
            $list_inventary = json_decode($this->list_inventary, true);

            $countItemsInArray = count($list_inventary);
            for($i = 0; $i < $countItemsInArray; $i++){
		
                $arr = $list_inventary[$i]["product_items"];
                $count_product = count($arr);

                $product_count = $list_inventary[$i]["product_count"];

                $item_count_actual = 0;
                $countToCalculate = 0;
                $countToDiscount = 0;
                $item_count = 0;

                for ($index=0; $index < $count_product; $index++) { 
                    $item_id = $list_inventary[$i]["product_items"][$index]["item_id"];
                    $item_count_index = $list_inventary[$i]["product_items"][$index]["item_count"];
    
                    $sqlQuery = "SELECT
                        item_id,
                        item_count
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        item_id = :item_id ";

                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(":item_id", $item_id);

                    $stmt->execute();
                    $registro_count[] = array();
                    while ($rowItem = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($rowItem);
                        $registro_count[] = array('item_id'=>$item_id,'item_count'=>$item_count);
                        $countToCalculate =  $item_count_index * $product_count;
                        $countToDiscount =  $item_count - $countToCalculate;
                    }

                    
                    
                    if(isset($registro_count)){
                        $sqlQuery = "UPDATE
                                    ". $this->db_table ."
                                    SET
                                    item_count = :item_count
                                    WHERE 
                                    item_id = :item_id ";
                                    
                        $stmt = $this->conn->prepare($sqlQuery);
                         
                        $stmt->bindParam(":item_id", $item_id);
                        $stmt->bindParam(":item_count", $countToDiscount);
                        $stmt->execute();
                    }
                    
                }
            }
    

            return false;
        }
        
    }
?>