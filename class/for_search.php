<?php
  
   include 'crm.php';

   class SearchValue{
       
    private $name;
    private $nameErr;
    private $crm;
    private $leads;

    public function __construct(){
          $this->name = "";
          $this->nameErr="";
          $this->crm = New CRM();
          $this->leads = [];
    }

    public function getleads(){
        return $this->leads;
    }
    public function getnameErr(){
        return $this->nameErr;
    }
    public function getName(){
        return $this->name;
    }

    public function testinput($data){
          $data = trim($data);
          $data = stripslashes($data);
          return $data;
    }

    public function Process($postman){

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($postman["name"])){
                $this->nameErr = "Name is Required";
            }
            else{
                $this->name = $this->testinput($postman["name"]);

                if (!preg_match("/^[a-zA-Z-' ]*$/", $this->name)) {
                    $this->nameErr = "Only letters and white space allowed";
                }
            }

            if($this->nameErr === "" && $this->name!==""){
                 $this->leads = $this->crm->searchLead($this->name);
                // var_dump($this->leads);
                 //die();
            }
        }

    }
     
   }

?>