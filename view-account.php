<?php
    //this needs all required files

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>View account - iBank</title>
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
					<th width="10%">Date</th><th width="30%">Transaction</th><th width="30%">Amount</th><th width="30%">Balance</th>
				 <?php
				 	for($i = 0; $i < 15; $i++)
				 	{
				 		if($i %2)
						{
							?><tr bgcolor="#DDD"><td>08/05/2013</td><td>123456</td><td>-$150.00</td><td>$2,010.00</td></tr><?php
						}
						else
						{
							?><tr bgcolor="#CCC"><td>08/05/2013</td><td>123456</td><td>-$150.00</td><td>$2,010.00</td></tr><?php
						}
				 	}
				 ?>
				 <tr style="color:white; font-size:1.2em; font-weight:bold"><td></td><td></td><td>Account total:</td><td>$2,000,068.91</td></tr>
				</table>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				<table width="100%">
					<th>Accrued interest</th><th>Amount</th>
					<tr><td>Interest to date:</td><td>$2.68</td></tr>
					<tr bgcolor="#CCC"><td>Interest frequency:</td><td>Monthly</td></tr>
					<tr><td>Interest rate p/a:</td><td>6.00%</td></tr>
				</table>
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
