<?php

   include 'crm.php';
   
    class LeadFromHandel{
        public $name;
        public $email;
        public $phone;
        public $nameErr;
        public $emailErr;
        public $phoneErr;
        public $submitted;
        public $result;
        private $crm;

        public function __construct()
        {
            $this->crm = new CRM();
            $this->name = $this->email = $this->phone = "";
            $this->nameErr = $this->emailErr = $this->phoneErr = "";
            $this->submitted = false;
            $this->result = "";
        }

        public function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);

            return htmlspecialchars($data);
        }

        public function Process($postman){
             if($_SERVER["REQUEST_METHOD"]=="POST"){

                //var_dump($postman);
                // die();
                 
                if(empty($postman["name"])){
                    $this->nameErr = "Name is Required";
                }
                else{
                    $this->name = $this->testinput($postman["name"]);
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $this->name)) {
                        $this->nameErr = "Only letters and white space allowed";
                    }
                }

                if(empty($postman["email"])){
                    $this->emailErr = "Email is Required";
                }
                else{
                    $this->email = $this->testinput($postman["email"]);
                    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                        $this->emailErr = "Invalid email format";
                    }
                }

                if(empty($postman["phone"])){
                    $this->phoneErr = "Phone is Required";
                }
                else{
                    $this->phone = $this->testinput($postman["phone"]);
                    if (!preg_match("/^\+?[0-9\s\-\(\)]{7,15}$/", $this->phone)) {
                        $this->phoneErr = "Invalid phone number format";
                    }
                }

                if($this->nameErr === "" && $this->emailErr === "" && $this->phoneErr === "" &&
                 $this->name !== "" && $this->email !== "" && $this->phone !==""){
                      $this->crm->addLead($this->name,$this->email,$this->phone);
                       $this->submitted = true;
                       $this->result = "Successfully Added!";
                }
             }
        }
    }

?>