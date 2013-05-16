<?php
	session_start();
	include '../db_layer/DataStore.php';

	$datastore->accumulateInterest();
	
	header('LOCATION: ../manager.php');
?>