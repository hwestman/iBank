<?php

	include "check.php";
	include "db_layer/DataStore.php";
     session_start();
     
     $user = $datastore->getUser($_SESSION['login']['id']);
     
     if(isset($_POST['Next']))
    {
    	$_SESSION['transfer'];
	    $memo = $_POST['memo'];
	    $_SESSION['transfer']['memo'] = $memo;
	    $toAccount = $_POST['toAccount'];
	    $_SESSION['transfer']['toAccount'] = $toAccount;
	    $amount = $_POST['amount'];
	    $_SESSION['transfer']['amount'] = $amount;
	    
	    header('LOCATION: teller-bank-transfer-confirm.php');
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
	    <title>Bank transfer - iBank</title>
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
				<h2>Bank deposit</h2>
				<form name="transfer" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<table>
						<tr><td>From account:</td><td style="text-align: left">Teller deposit</td></tr>
						<tr><td>Memo:</td><td><input class="left" type="text" name="memo" value="Bank deposit"<?php if($transfer){ 
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
					<input type="reset" class="button" id="left" name="cancel" onclick="location.href='teller.php'" value="Cancel"/>
					<input type="submit" class="button" id="right" name="Next" value="Next">
				</form>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				The funds will be available in the persons bank account instantly.
				<br/>
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
