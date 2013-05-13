<?php

session_start();
//Check if user is logged in
if(!$_SESSION['login'])
{
	//if not logged in send them back to the login screen
	header("LOCATION: login.php");
}




?>