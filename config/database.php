<?php 
  
   class DATABASE{
      private $host = "localhost";
      private $dbname = "CRM_SYSTEM";
      private $username = "joyed";
      private $password = "Joyed@1234";
      private $conn;

      public function dbconnection(){
         $this->conn = null;
         try{
             $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname , $this->username,$this->password);
             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             return $this->conn;
         }
         catch(PDOException $e){
            echo "Connection Error:" .$e->getMessage();
         }
      }
   }

?>