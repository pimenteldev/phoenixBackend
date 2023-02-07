<?php
    class Settings{

        // Connection
        private $conn;

        // Table
        private $db_table = "settings";

        // Columns
        public $id;
        public $price_dollar;
        public $percent_iva;
        public $count_items_inventary;
        public $num_control;
        public $facturation_initial;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllSettings(){
            $sqlQuery = "SELECT
                        id,
                        price_dollar, 
                        percent_iva, 
                        count_items_inventary,
                        num_control,
                        facturation_initial
                        FROM
                        ". $this->db_table;

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function updateDolar(){

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        price_dollar = :price_dollar
                        WHERE 
                        id = :id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->price_dollar=htmlspecialchars(strip_tags($this->price_dollar));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":price_dollar", $this->price_dollar);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateIva(){

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        percent_iva = :percent_iva
                        WHERE 
                        id = :id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->percent_iva=htmlspecialchars(strip_tags($this->percent_iva));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":percent_iva", $this->percent_iva);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateCountItemsInventary(){

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        count_items_inventary = :count_items_inventary
                        WHERE 
                        id = :id ";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->count_items_inventary=htmlspecialchars(strip_tags($this->count_items_inventary));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":count_items_inventary", $this->count_items_inventary);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        
    }
?>

