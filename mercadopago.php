<?php
    include_once "db.php";
    class mercadoPago {  

        private function random(){
            $per = 10;     //failure percentage
            $ran = rand(0, 100);
            return $ran>$per;
        }

        public function pay($number,$name,$exp,$sec,$dni) { 
            $conn = conn();
            return $this->random();
        } 

        public function checkCard($number,$name,$exp,$sec,$dni){
            $conn = conn();
            return $this->random();
        }
    }    
?>