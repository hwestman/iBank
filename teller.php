<?php

	session_start();
	
	include "check.php";
	
	$savingsAmount = "52012.55";
	$chequeAmount = "10012.50";
	$creditAmount = "-2561.12";
	$loanAmount = "-250321.87";
	
	$savingsAccount = "12345678";
	$chequeAccount = "12387654";
	$creditAccount = "87654321";
	$loanAccount = "81726354";
	

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Mi Account - iBank</title>
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
					<th width="30%">Account number</th><th width="35%">Account type</th><th width="35%">Balance</th>
					<tr bgcolor="#DDD"><td><a href="view-account.php?accountNumber=<?php echo $savingsAccount;?>"><?php echo $savingsAccount; ?></a></td><td>Savings</td><td>$<?php echo $savingsAmount;?></td></tr>
					<tr bgcolor="#CCC"><td><a href="view-account.php?accountNumber=<?php echo $chequeAccount;?>"><?php echo $chequeAccount; ?></a></td><td>Cheque</td><td>$<?php echo $chequeAmount;?></td></tr>
					<tr bgcolor="#DDD"><td><a href="view-account.php?accountNumber=<?php echo $creditAccount;?>"><?php echo $creditAccount; ?></a></td><td>Credit</td><td>$<?php echo $creditAmount;?></td></tr>
					<tr bgcolor="#CCC"><td><a href="view-account.php?accountNumber=<?php echo $loanAccount;?>"><?php echo $loanAccount; ?></a></td><td>Loan</td><td><?php echo $loanAmount;?></td></tr>
					<tr style="color:white; font-size:1.2em; font-weight:bold"><td></td><td>Total debt:</td><td>$<?php echo $creditAmount+$loanAmount;?></td></tr>
					<tr style="color:white; font-size:1.2em; font-weight:bold"><td></td><td>Total credit:</td><td>$<?php echo $savingsAmount+$chequeAmount;?></td></tr>
				</table>
			</div><!--CLOSE CONTENT MAIN-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
