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

       public function displayLead(){
          $db = new DATABASE();
          $pdo = $db->dbconnection();
            
          //Direct access on database
          // $stmt = $pdo->query("SELECT * FROM Leads");
          // return var_dump($stmt->fetchAll(PDO:: FETCH_ASSOC));
          

          //based on prepare execute
         $stmt = $pdo->prepare("SELECT * FROM Leads");
          $stmt->execute([]);
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }
       public function updateLead($id,$name,$email,$phone){

         $db = new DATABASE();
         $pdo = $db->dbconnection();

         $stmt = $pdo->prepare("UPDATE Leads SET name = ?, email = ?, phone = ? WHERE id = ?");
         $stmt->execute([$name,$email,$phone,$id]);

       }
   }

?>