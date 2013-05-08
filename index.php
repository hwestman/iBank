<?php
    //this needs all required files

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
					<tr bgcolor="#DDD"><td>12345678</td><td>Savings</td><td>$52,012.50</td></tr>
					<tr bgcolor="#CCC"><td>12387654</td><td>Cheque</td><td>$10,012.50</td></tr>
					<tr bgcolor="#DDD"><td>87654321</td><td>Credit</td><td>-$2,561.12</td></tr>
					<tr bgcolor="#CCC"><td>81726354</td><td>Loan</td><td>-$250,321.87</td></tr>
					<tr style="color:white; font-size:1.2em; font-weight:bold"><td></td><td>Total debt:</td><td>-$252,882.99</td></tr>
					<tr style="color:white; font-size:1.2em; font-weight:bold"><td></td><td>Total credit:</td><td>$62,025.00</td></tr>
				</table>
			</div><!--CLOSE CONTENT MAIN-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
