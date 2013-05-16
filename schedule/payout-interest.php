<?php
	session_start();
	include "../db_layer/DataStore.php";
	
	$datastore->payoutInterest();
	
	header('LOCATION: ../manager.php');
?>