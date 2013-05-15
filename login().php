<?php

include 'db_layer/DataStore.php';

    

	session_start();
    
	if(isset($_POST['login']))
	{
        global $datastore;
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $login = $datastore->attemptLogin($username,$password);
        $login['datastore'] = $datastore;
        $_SESSION['login'] = $login; 
        
	}
	/*
	if($username == "customer")
	{
		$_SESSION['login']['cust'] = true;
	}
	else if($username == "teller")
	{
		$_SESSION['login']['teller'] = true;
	}
	else if($username == "manager")
	{
		$_SESSION['login']['manager'] = true;
	}
    */
	header("LOCATION: index.php");
?>