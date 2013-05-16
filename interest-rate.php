<?php
	include "check.php";
	include "db_layer/DataStore.php";

	session_start();
	
	$interestRate = array();
	$interestRate = $datastore->getInterestRate();
	
	$_SESSION['interestRates'] = $interestRate; 
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Interest rates - iBank</title>
	    <meta charset="UTF-8"/>
	    <link rel="stylesheet" type="text/css" href="css/style.css" />
	    <link rel="stylesheet" type="text/css" href="css/menu.css" />
	    <link rel="stylesheet" type="text/css" href="css/button.css" />
	    <!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	    <script src="js/onload.js" type="text/javascript"></script>
-->
	</head>

	<div id="container">
		<?php include "include/header.php"; ?>
		<div id="content">
			<div id="content-main">
				<table>
					<th width="35%">Account type</th><th width="35%">Interest rate per annum</th>
					<tr bgcolor="#DDD"><td>Savings</td><td><?php echo $interestRate[0];?>%</td></tr>
					<tr bgcolor="#CCC"><td>Credit</td><td><?php echo $interestRate[1];?>%</td></tr>
					<tr bgcolor="#DDD"><td>Cheque</td><td><?php echo $interestRate[2];?>%</td></tr>
					<tr bgcolor="#CCC"><td>Loan</td><td><?php echo $interestRate[3];?>%</td></tr>
					<a href="update-interest-rate.php"><input type="submit" class="button" id="right" name="Update" value="Update"></a>
				</table>
			</div><!--CLOSE CONTENT MAIN-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
