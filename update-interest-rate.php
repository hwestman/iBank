<?php
	include "check.php";
	include "db_layer/DataStore.php";

	session_start();
	
	if(isset($_POST['Update']))
	{
		$_SESSION['interestRates'][0] = $_POST['savings'];
		$_SESSION['interestRates'][1] = $_POST['credit'];
		$_SESSION['interestRates'][2] = $_POST['cheque'];
		$_SESSION['interestRates'][3] = $_POST['loan'];
		
		$updatedInterestRates = $datastore->updateInterestRate($_SESSION['interestRates'][0], $_SESSION['interestRates'][1], $_SESSION['interestRates'][2], $_SESSION['interestRates'][3]);
		
		header('LOCATION: interest-rate.php');
	}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Update interest rate - iBank</title>
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
			<form name="interest-rate" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
				<table>
					<th width="35%">Account type</th><th width="35%">Interest rate per annum</th>
					<tr bgcolor="#DDD"><td>Savings</td><td><input type="text" name="savings" class="left" value="<?php echo $_SESSION['interestRates'][0];;?>"/>%</td></tr>
					<tr bgcolor="#CCC"><td>Credit</td><td><input type="text" name="cheque" class="left" value="<?php echo $_SESSION['interestRates'][1];?>"/>%</td></tr>
					<tr bgcolor="#DDD"><td>Cheque</td><td><input type="text" name="credit" class="left" value="<?php echo $_SESSION['interestRates'][2];?>"/>%</td></tr>
					<tr bgcolor="#CCC"><td>Loan</td><td><input type="text" name="loan" class="left" value="<?php echo $_SESSION['interestRates'][3];?>"/>%</td></tr>
				</table>
				<input type="reset" class="button" id="left" name="cancel" onclick="location.href='interest-rate.php'" value="Cancel"/>
				<input type="submit" class="button" id="right" name="Update" value="Update"/>
			</form>
			</div><!--CLOSE CONTENT MAIN-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
