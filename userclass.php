<?php
/*
Author: Hallvard Westman
Project: Links
 ---------------------------------USERCLASS----------------------------------------*/

class User {

    var $db;
	
    var $userID;


    public function __construct($db) {		//constructor
        $this->db = $db;					
    
        $this->userID = -1;
   
    }

    public function dologin($uid) { // login funksjonen
        $this->userId = $_SESSION['userId'] = $uid;
		
            header('location: links.php?id='.$uid);
    }

    public function logout() {	// loggut frunksjon
        session_unset();		//unsetter session og så destroyer den
        session_destroy();
    }

   public function loggedOn() {	// hvis bruker er logget på funksjon
        if (isset($_SESSION['userId']))
            return true;
        else
            return false;
    }

    public function getID() {	//henter ID til bruker
        if ($this->loggedOn())
            return $_SESSION['userId'];
        else
            return null;
    }

}

?>
