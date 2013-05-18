<?php
    
	session_start();
	
	include "check.php";
	include "db_layer/DataStore.php";
    $savings = $datastore->savings();
    $credit = $datastore->credit();
    $cheque = $datastore->cheque();
    $loan = $datastore->loan();
    
    $user = $datastore->getUser($_SESSION['login']['id']);
    
    $interestRate = array();
	$interestRate = $datastore->getInterestRate();
	
	$_SESSION['interestRates'] = $interestRate; 
    
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Manager - iBank</title>
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
				<div class="stats">
					<table>
						<tr bgcolor="#DDD"><td>Total savings:</td><td>$<?php echo $savings[0]['balance']?></td></tr>
						<tr bgcolor="#CCC"><td>Total accrued interest</td><td>$<?php echo $savings[0]['interestSum']?></td></tr>
						<tr><td>Interest rate</td><td><?php echo $interestRate[0];?>%</td></tr>
					</table>
				</div><!--CLOSE STATS -->
				<div class="stats">
					<table>
						<tr bgcolor="#DDD"><td>Total credit:</td><td>$<?php echo $credit[0]['balance']?></td></tr>
						<tr bgcolor="#CCC"><td>Total accrued interest</td><td>$<?php echo $credit[0]['interestSum']?></td></tr>
						<tr><td>Interest rate</td><td><?php echo $interestRate[1];?>%</td></tr>
					</table>
				</div><!--CLOSE STATS -->
				<div class="stats">
					<table>
						<tr bgcolor="#DDD"><td>Total cheque:</td><td>$<?php echo $cheque[0]['balance']?></td></tr>
						<tr bgcolor="#CCC"><td>Total accrued interest</td><td>$<?php echo $cheque[0]['interestSum']?></td></tr>
						<tr><td>Interest rate</td><td><?php echo $interestRate[2];?>%</td></tr>
					</table>
				</div><!--CLOSE STATS -->
				<div class="stats">
					<table>
						<tr bgcolor="#DDD"><td>Total loan:</td><td>$<?php echo $loan[0]['balance']?></td></tr>
						<tr bgcolor="#CCC"><td>Total accrued interest</td><td>$<?php echo $loan[0]['interestSum']?></td></tr>
						<tr><td>Interest rate</td><td><?php echo $interestRate[3];?>%</td></tr>
					</table>
				</div><!--CLOSE STATS -->
				<a href="update-interest-rate.php"><input type="submit" class="button" id="right" name="Update" value="Update interest rate"></a>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				<table>
					<th width="40%">Your details</th><th width="70%"><?php echo $user->login_id;?></th>
					<tr bgcolor="#DDD"><td>Full name:</td><td><?php echo $user->full_name;?></td></tr>
					<tr bgcolor="#CCC"><td>Address:</td><td><?php echo $user->street_address;?></td></tr>
					<tr bgcolor="#DDD"><td>Suburb:</td><td><?php echo $user->suburb_name." ".$userInfo->post_code;?></td></tr>
					<tr bgcolor="#CCC"><td>State:</td><td><?php echo $user->county;?></td></tr>
					<tr bgcolor="#DDD"><td>Contact:</td><td><?php echo $user->contact_number;?></td></tr>				
				</table>
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
