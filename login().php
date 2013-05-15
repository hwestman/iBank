<?php

include 'db_layer/DataStore.php';

    

	session_start();
    
	if(isset($_POST['login']))
	{
        global $datastore;
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $login = $datastore->attemptLogin($username,$password);
        if($login){
            $_SESSION['login'] = $login; 
        }
	}
    switch ($_SESSION['login']['priv']) {
        case 1:
            header("LOCATION: mibank.php");
            break;
        case 2:
            header("LOCATION: teller.php");
            break;
        case 3:
            header("LOCATION: manager.php");
            break;
        default:
            header("LOCATION: index.php");
            break; 
    }
?>