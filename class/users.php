<?php

    class User{

        // Connection
        private $conn;

        // Table
        private $db_table = "users";

        // Columns
        public $user_id;
        public $user_psw;
        public $user_name;
        public $user_photo;
        
        public $user_rol;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function login(){
            $sqlQuery = "SELECT
                        user_id,
                        user_name, 
                        user_photo,
                        user_rol
                        FROM
                        ". $this->db_table ."
                        WHERE 
                        user_id = :user_id
                        AND
                        user_psw = :user_psw";

            $stmt = $this->conn->prepare($sqlQuery);

            // Sanitize
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->user_psw=htmlspecialchars(strip_tags($this->user_psw));

            // Bind
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":user_psw", $this->user_psw);

            $stmt->execute();
            return $stmt;
            
        }

    }
