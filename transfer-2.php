<?php
    //this needs all required files
    
    session_start();
    
    if(isset($_POST['Back']))
    {
	    header('LOCATION: transfer.php');
    }
    else if(isset($_POST['Transfer']))
    {
	    header('LOCATION: transfer-3.php');
    }
    
    if(isset($_SESSION['transfer']))
    {
	    $fromAccount = $_SESSION['transfer']['fromAccount'];
	    $memo = $_POST['memo'] = $_SESSION['transfer']['memo'];
	    $toAccount = $_POST['toAccount'] = $_SESSION['transfer']['toAccount'];
	    $amount = $_POST['amount'] = $_SESSION['transfer']['amount'];
    }

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Verify transfer - iBank</title>
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
				<h2 align="center">Please check the details below before transferring the funds from your nominated bank account.</h2>
				<form name="transfer" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<table>
						<tr><td>From account:</td><td><input class="left" type="text" name="fromAccount" readonly="readonly" value="<?php echo $fromAccount; ?>" size="30"/></td></tr>
						<tr><td>Memo:</td><td><input class="left" type="text" name="memo" readonly="readonly" value="<?php echo $memo; ?>" size="30" maxlength="18"/></td></tr>
						<tr><td><hr></td><td><hr></td></tr>
						<tr><td>To account:</td><td><input class="left" type="text" name="toAccount" readonly="readonly" value="<?php echo $toAccount; ?>" size="30" maxlength="8"/></td></tr>
						<tr><td>Amount: $</td><td><input class="left" type="text" name="amount" readonly="readonly" value="<?php echo $amount; ?>" size="20" maxlength="4"/></td></tr>
					</table>
					<input type="submit" class="button" id="left" name="Back" value="Back">
					<input type="submit" class="button" id="right" name="Transfer" value="Transfer">
				</form>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				The funds will be available in the persons bank account instantly.
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
