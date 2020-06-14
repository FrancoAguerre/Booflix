<?php
    include_once "db.php";
    class mercadoPago {  

        private function random(){
            $per = 10;     //failure percentage
            $ran = rand(0, 100);
            return $ran>$per;
        }

        private function isEven($number){
            return $number % 2 == 0;
        }

        public function pay($number,$name,$exp,$sec,$dni) { 
            $conn = conn();
            return $this->random();
            //return $this->isEven($number);
        } 

        public function checkCard($number,$name,$exp,$sec,$dni){
            $conn = conn();
            //return $this->random();
            return $this->isEven($number);
        }
    }    
?>