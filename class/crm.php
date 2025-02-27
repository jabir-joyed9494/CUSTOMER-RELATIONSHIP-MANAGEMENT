<?php 

  include 'lead.php';
  
   class CRM{
      public $leads;

      public function __construct()
      {
         $this->leads = new Lead();
      }

      public function addLead($name,$email,$phone){
           $this->leads->addLead($name,$email,$phone);
      }
      public function searchLead($name){
        return $this->leads->searchLead($name);
      }
   }
  

?>