<?php
    //this needs all required files
    
    session_start();

    include "db_layer/DataStore.php";
    $accountNumber = $_GET['accountNumber'];
    
    $_SESSION['login']['account_context'] = $datastore->getAccount($accountNumber);
    $transactions = $datastore->getTransactions($accountNumber);
    $interest = $datastore->getInterest($_SESSION['login']['account_context']->accountType);
    $accumulatedInterest = $datastore->getAccumulated($accountNumber);
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
					<h2>Account number: <?php echo $accountNumber; ?></h2>
					<th width="10%">Date</th><th width="25%">Transaction</th><th width="25%">Memo</th><th width="10%">Amount</th>
				 <?php
				 	foreach($transactions as $key=>$transaction)
				 	{
				 		if($key %2)
						{
							?><tr bgcolor="#DDD">
                                <td><?php echo $transaction->date ?></td>
                                <td><a href="transaction-details.php?transactionId=<?php echo $transaction->id;?>"><?php echo $transaction->id;?></a></td>
                                <td><?php echo $transaction->memo;?></td>
                                <td><?php echo '$ '; if($transaction->from == $_SESSION['login']['account_context']->accountNumber){echo '- ';} echo $transaction->amount;?></td></tr><?php
						}
						else
						{
							?><tr bgcolor="#CCC"><td><?php echo $transaction->date ?></td>
                        <td><a href="transaction-details.php?transactionId=<?php echo $transaction->id;?>"><?php echo $transaction->id;?></a></td>
                        <td><?php echo $transaction->memo;?></td>
                        <td><?php echo '$ '; if($transaction->from == $_SESSION['login']['account_context']->accountNumber){echo '- ';} echo $transaction->amount;?></td></tr><?php
						}
				 	}
				 ?>
				 <tr style="color:white; font-size:1.2em; font-weight:bold"><td></td><td></td><td>Account total:</td><td>$<?php echo $_SESSION['login']['account_context']->balance ?></td></tr>
				</table>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				<table width="100%">
					<th>Accrued interest</th><th>Amount</th>
					<tr><td>Interest to date:</td><td>$ <?php echo $accumulatedInterest ?></td></tr>
					<tr bgcolor="#CCC"><td>Interest frequency:</td><td>Monthly</td></tr>
					<tr><td>Interest rate p/a:</td><td><?php echo $interest['rate']; ?> %</td></tr>
				</table>
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
