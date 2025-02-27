<?php 

  include 'config/database.php';
    class Lead{
       
       public function addLead($name,$email,$phone){
           
           $db = new DATABASE();
           $pdo = $db->dbconnection();

            $stmt = $pdo->prepare("INSERT INTO Leads (name, email, phone) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $phone]);
       }

       public function searchLead($name){
          $db = new DATABASE();
          $pdo = $db->dbconnection();

          $stmt = $pdo->prepare("SELECT * FROM Leads WHERE name LIKE ?");
          $stmt->execute(['%'. $name . '%']);

          return $stmt->fetchAll(PDO:: FETCH_ASSOC);
       }
   }

?>