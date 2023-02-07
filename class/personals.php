<?php
    class Personals{

        // Connection
        private $conn;

        // Table
        private $db_table = "personals";
        private $db_table_innerRole = "role";

        // Columns
        public $personal_document;
        public $personal_alias;
        public $personal_name;
        public $personal_role;
        public $personal_photo;
        public $personal_photo_thumb;
        public $personal_status;
        public $personal_user;
        public $personal_password;


        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllPersonals(){
            $sqlQuery = "SELECT
                        personal_document, 
                        personal_alias, 
                        personal_name,
                        personal_role,
                        personal_photo,
                        personal_photo_thumb,
                        personal_status
                        FROM
                        ". $this->db_table." 
                        ORDER BY personal_role DESC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAllPersonalsInnkeeper(){
            $sqlQuery = "SELECT
                        personal_document, 
                        personal_alias, 
                        personal_name,
                        personal_role,
                        personal_photo,
                        personal_photo_thumb,
                        personal_status
                        FROM
                        ". $this->db_table." AS p
                        INNER JOIN
                        ". $this->db_table_innerRole." AS r
                        ON
                        p.personal_role=r.role_id
                        AND
                        r.role_seller = 1 
                        AND 
                        p.personal_status=1
                        ORDER BY p.personal_name DESC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSinglePersonal(){

            $sqlQuery = "SELECT
                        personal_document, 
                        personal_alias, 
                        personal_name,
                        personal_role,
                        personal_photo,
                        personal_photo_thumb,
                        personal_status
                        FROM
                        ". $this->db_table." 
                        WHERE 
                        personal_document = :personal_document ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":personal_document", $this->personal_document);

            $stmt->execute();
            return $stmt;
        }

        public function createPersonal(){
            $sqlQuery = "INSERT INTO 
                        ". $this->db_table." (
                        personal_document, 
                        personal_name,
                        personal_alias, 
                        personal_role,
                        personal_photo,
                        personal_photo_thumb )
                        VALUES (
                        :personal_document, 
                        :personal_name,
                        :personal_alias, 
                        :personal_role,
                        :personal_photo,
                        :personal_photo_thumb )";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->personal_document=htmlspecialchars(strip_tags($this->personal_document));
            $this->personal_name=htmlspecialchars(strip_tags($this->personal_name));
            $this->personal_alias=htmlspecialchars(strip_tags($this->personal_alias));
            $this->personal_role=htmlspecialchars(strip_tags($this->personal_role));
            $this->personal_photo=htmlspecialchars(strip_tags($this->personal_photo));
            $this->personal_photo_thumb=htmlspecialchars(strip_tags($this->personal_photo_thumb));

            $stmt->bindParam(":personal_document", $this->personal_document);
            $stmt->bindParam(":personal_name", $this->personal_name);
            $stmt->bindParam(":personal_alias", $this->personal_alias);
            $stmt->bindParam(":personal_role", $this->personal_role);
            $stmt->bindParam(":personal_photo", $this->personal_photo);
            $stmt->bindParam(":personal_photo_thumb", $this->personal_photo_thumb);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updatePersonal(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        personal_name = :personal_name, 
                        personal_alias = :personal_alias,
                        personal_role = :personal_role, 
                        personal_photo = :personal_photo,
                        personal_photo_thumb = :personal_photo_thumb,
                        personal_status = :personal_status
                        WHERE 
                        personal_document = :personal_document ";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->personal_document=htmlspecialchars(strip_tags($this->personal_document));
            $this->personal_name=htmlspecialchars(strip_tags($this->personal_name));
            $this->personal_alias=htmlspecialchars(strip_tags($this->personal_alias));
            $this->personal_role=htmlspecialchars(strip_tags($this->personal_role));
            $this->personal_photo=htmlspecialchars(strip_tags($this->personal_photo));
            $this->personal_photo_thumb=htmlspecialchars(strip_tags($this->personal_photo_thumb));
            $this->personal_status=htmlspecialchars(strip_tags($this->personal_status));

            $stmt->bindParam(":personal_document", $this->personal_document);
            $stmt->bindParam(":personal_name", $this->personal_name);
            $stmt->bindParam(":personal_alias", $this->personal_alias);
            $stmt->bindParam(":personal_role", $this->personal_role);
            $stmt->bindParam(":personal_photo", $this->personal_photo);
            $stmt->bindParam(":personal_photo_thumb", $this->personal_photo_thumb);
            $stmt->bindParam(":personal_status", $this->personal_status);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function removePersonal(){
            $sqlQuery = "DELETE FROM
                        ". $this->db_table ."
                        WHERE 
                        personal_document = :personal_document";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->personal_document=htmlspecialchars(strip_tags($this->personal_document));
            $stmt->bindParam(":personal_document", $this->personal_document);
            
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

