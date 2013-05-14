<?php

	include "check.php";
     session_start();
     
     if(isset($_POST['Next']))
    {
    	$_SESSION['transfer'];
	    $fromAccount = $_POST['fromAccount'];
	    $_SESSION['transfer']['fromAccount'] = $fromAccount;
	    $memo = $_POST['memo'];
	    $_SESSION['transfer']['memo'] = $memo;
	    $toAccount = $_POST['toAccount'];
	    $_SESSION['transfer']['toAccount'] = $toAccount;
	    $amount = $_POST['amount'];
	    $_SESSION['transfer']['amount'] = $amount;
	    
	    header('LOCATION: transfer-2.php');
    }
    else if(isset($_POST['Cancel']))
    {
	    unset($_SESSION['transfer']);
    }
    
    if(isset($_SESSION['transfer']))
     {
     	$transfer = true;
     }

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Transfer - iBank</title>
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
				Maximum transfer limit per day: $4,000.00
				<form name="transfer" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<table>
						<tr><td>From account:</td><td><input class="left" type="text" name="fromAccount" <?php if($transfer){ 
							echo "value=\"".$_SESSION['transfer']['fromAccount']."\"";} else { echo "placeholder=\"Drop down menu goes here\"";}?> 
						size="30"/ maxlength="8"></td></tr>
						<tr><td>Memo:</td><td><input class="left" type="text" name="memo" <?php if($transfer){ 
							echo "value=\"".$_SESSION['transfer']['memo']."\"";} else { echo "placeholder=\"Distinctive text of transaction\"";}?> 
						size="30" maxlength="18"/></td></tr>
						<tr><td><hr></td><td><hr></td></tr>
						<tr><td>To account:</td><td><input class="left" type="text" name="toAccount" <?php if($transfer){ 
							echo "value=\"".$_SESSION['transfer']['toAccount']."\"";} else { echo "placeholder=\"8 digit account number\"";}?>
						size="30" maxlength="8"/></td></tr>
						<tr><td>Amount: $</td><td><input class="left" type="text" name="amount" <?php if($transfer){ 
							echo "value=\"".$_SESSION['transfer']['amount']."\"";} else { echo "placeholder=\"How much?\"";}?> 
						size="20" maxlength="10"/></td></tr>
					</table>
					<input type="reset" class="button" id="left" name="cancel" onclick="location.href='index.php'" value="Cancel"/>
					<input type="submit" class="button" id="right" name="Next" value="Next">
				</form>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				The funds will be available in the persons bank account instantly.
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
