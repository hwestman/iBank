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

    public function getLoginForm() { //Henter loggin/loggut form
        if ($this->loggedOn() == true)
            return "<form method='post' action='authenticate.php'>\n
			<input type='hidden' name='logout' value='true'/>\n
			<input type='submit' value='Logg av'/>\n</form>";
        else    {
            return "<form method='post' action='authenticate.php'><ul>
		<li><input type='text' name='userId' value='Username'><br/></li>
		<li><input type='password' name='passWord' value=''><br/></li>
		<li><button type='submit'/>Login</button></li>
		</ul></form>";
        }
    }

}

$user = new User($db);	//oppretter bruker
if (isset($needLogin) && !$user->loggedOn())
    die('You need to be logged on to do this!');
?>
