<?php
    //*****************************************************/
    // Contact Controller
    // Handles HTTP GET and POST Requests
    //*****************************************************/
    /*
    | Request Method | Action  |  Task   
    -----------------------------------
    | GET            | list    | Display Contact List
    | GET            | add     | Display Contact Form
    | POST           | add     | Process Add Form (Add to DB Table)
    | GET            | login   | Display Login Form
    | POST           | login   | Process Login and Authenticate
    | GET            | delete  | Delete Row from DB Table
    | POST           | delete  | Delete Row from DB Table
    -----------------------------------   
    */
    require_once 'model/ContactDAO.php';

    session_start();

    showErrors(1);

    if(isset($_REQUEST['action'])){
        $action=$_REQUEST['action'];
    }else{
        $action='list';
    }

    if($action=='login'){
        $contactDAO = new ContactDAO();
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            // ** HTTP POST action='add' **
            // 1. Handle User input from HTTP Request
            $username = $_POST['username'];
            $passwd = $_POST['passwd'];
            // 3. Call the Data Access Object(DAO) API Method (Update Model)
            $contact=$contactDAO->authenticate($username,$passwd);
            if($contact==null){
                $_SESSION['message']='Invalid Username/Password Combination';
                header('Location: contactController.php?action=login');  //Redirect
                exit;     
            }else{
                $_SESSION['loggedin']=true;
                header('Location: contactController.php?action=list');  //Redirect
                exit;  
            }
        }else{
            // ** HTTP GET action='add' **
            include 'views/login.php'; //Next View
        }
    }

    //***   Authentication Check **** */
    if($action!='login'){
        if(!isset($_SESSION['loggedin'])){
            header('Location: contactController.php?action=login');  //Redirect
            exit;         
        }
    }
    
    if($action=='list'){
        // ** HTTP GET action='list' **
        //1. Handle User Input
        //2. Call DAO Method in Model
        $contactDAO = new ContactDAO();
        $contacts=$contactDAO->getContacts();
        //3. Select View
        include "views/listContacts.php"; //Next View
    }

    if($action=='add'){
        $contactDAO = new ContactDAO();
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            // ** HTTP POST action='add' **
            // 1. Handle User input from HTTP Request
            $username = $_POST['username'];
            $email = $_POST['email'];
            $address1 = $_POST['address1'];
            // 2. Package Input into a Data Transfer Object(DTO) container
            $contact = new Contact();
            $contact->username=$username;
            $contact->email=$email;
            $contact->address1=$address1;
            // 3. Call the Data Access Object(DAO) API Method (Update Model)
            $contactDAO->addContact($contact);
            // 4. Select View
            header('Location: contactController.php?action=list');  //Redirect
            exit;        
        }else{
            // ** HTTP GET action='add' **
            include 'views/contactForm.php'; //Next View
        }
    }

    if($action=='delete'){
        // ** Delete on a POST or a GET Request
        $contactDAO = new ContactDAO();
        $contactID = $_REQUEST['contactID'];
        $contactDAO->deleteContact($contactID);
        header('Location: contactController.php?action=list');  //Redirect
        exit;        
    }

    function showErrors($debug){
        if($debug==1){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }

?>
