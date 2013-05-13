<?php

	session_start();

	if(isset($_POST['Login']))
	{
		$username = $_POST['username'];
	}
	
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

	header("LOCATION: index.php");
?>