<?php
    require_once 'Contact.php';

    class ContactDAO {


        public function getConnection(){
            $mysqli = new mysqli("127.0.0.1", "cs2033user", "cs2033pass", "cs2033");
            if ($mysqli->connect_errno) {
                $mysqli=null;
            }
            return $mysqli;
        }

        public function addContact($contact){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("INSERT INTO contacts (username, email, address1) VALUES (?, ?, ?);");
            $stmt->bind_param("sss", $contact->username, $contact->email,$contact->address1);
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function deleteContact($contactID){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("DELETE FROM contacts WHERE contactID = ?;");
            $stmt->bind_param("i",$contactID);
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function getContacts(){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("SELECT * FROM contacts;"); 
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $contact = new Contact();
                $contact->load($row);
                $contacts[]=$contact;
            }    
            $stmt->close();
            $connection->close();
            return $contacts;
        }

        public function authenticate($userName, $passwd){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("SELECT * FROM contacts WHERE username = ? and passwd =?;"); 
            $stmt->bind_param("ss",$userName,$passwd);
            $stmt->execute();
            $result = $stmt->get_result();
            $contact=null;
            while($row = $result->fetch_assoc()){
                $contact = new Contact();
                $contact->load($row);
            }    
            $stmt->close();
            $connection->close();
            return $contact;
        }




    }
?>
