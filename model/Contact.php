<?php
    class Contact{
        public $contactID;
        public $username;
        public $email;
        public $address1;

        public function load($row){
            $this->contactID = $row['contactID'];
            $this->username=$row['username'];
            $this->email=$row["email"];
            $this->address1=$row['address1'];
        }
    
    }
?>