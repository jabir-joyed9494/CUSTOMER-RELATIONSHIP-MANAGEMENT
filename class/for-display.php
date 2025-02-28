<?php
     
     include 'crm.php';
     class DISPLAY{
        private $leads;
        private $crm;
          
        public function getLeads(){
           // var_dump($this->leads);
            return $this->leads;
        }

        public function __construct()
        {
            $this->leads = [];
            $this->crm = new CRM();
        }

        public function Process(){
            $this->leads = $this->crm->displayLead();
           // var_dump($this->leads);
            //die();
        }
     }
?>