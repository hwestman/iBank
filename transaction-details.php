<?php

	session_start();
	
	include "check.php";
    include_once "db_layer/DataStore.php";
    include_once "classes/Transaction.php";
    $account = $_SESSION['login']['account_context'];
    $transaction = $datastore->getTransaction($_GET['transactionId']);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Transaction details - iBank</title>
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
						<?php if($transaction->from == $account->accountNumber){ ?>
                            <tr><td>To account:</td><td><input class="left" type="text" name="toAccount" readonly="readonly" value="<?php echo $transaction->to." (".$transaction->toUser.")"; ?>" size="30"/></td></tr>
                            <tr><td>From account:</td><td><input class="left" type="text" name="fromAccount" readonly="readonly" value="<?php echo $account->accountTypeName." (".$transaction->from.")"; ?>" size="30"/></td></tr>
                            <tr><td>Amount: $</td><td><input class="left" type="text" name="amount" readonly="readonly" value="<?php echo "- ".$transaction->amount; ?>" size="20" maxlength="4"/></td></tr>
                            
                        <?php }else { ?>
                            <tr><td>To account:</td><td><input class="left" type="text" name="toAccount" readonly="readonly" value="<?php echo $account->accountTypeName." (".$transaction->to.")"; ?>" size="30"/></td></tr>
                            <tr><td>From account:</td><td><input class="left" type="text" name="fromAccount" readonly="readonly" value="<?php echo $transaction->from." (".$transaction->fromUser.")"; ?>" size="30"/></td></tr>
                            <tr><td>Amount: $</td><td><input class="left" type="text" name="amount" readonly="readonly" value="<?php echo $transaction->amount; ?>" size="20" maxlength="4"/></td></tr>
                        <?php } ?>
                        <tr><td>Message:</td><td><input class="left" type="text" name="memo" readonly="readonly" value="<?php echo $transaction->memo; ?>" size="30" maxlength="18"/></td></tr>
						<tr><td>Date:</td><td><input class="left" type="text" name="date" readonly="readonly" value="<?php echo $transaction->date; ?>" size="30" maxlength="18"/></td></tr>
						
						<tr><td></td></tr>
						<tr><td><strong>Receipt number:</strong></td><td style="text-align:left;"><?php echo $transaction->id; ?></td></tr>
					</table>
					<input type="submit" class="button" onClick="window.print()" id="right" name="Print" value="Print">
					<input type="reset" class="button" id="left" name="back" onclick="javascript: window.history.go(-1);" value="Back"/>
			</div><!--CLOSE CONTENT MAIN-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
