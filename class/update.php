<?php

  // include 'crm.php';
  
    class UPDATE{
        private $id;
        private $name;
        private $email;
        private $phone;

        private $crm;

        public function __construct()
        {
             $this->name = $this->email = $this->phone = "";
            // $this->id = 0;
            $this->crm = new CRM();
        }

        public function Process($postman){

                   if(($_SERVER["REQUEST_METHOD"])=="POST"){
                    $this->id = $postman['id'];
                    $this->name = $postman["name"];
                    $this->email = $postman["email"];
                    $this->phone = $postman["phone"];
                   }

              $this->crm->updateLead($this->id,$this->name,$this->email,$this->phone);
        }


    }

?>