<?php
    
	session_start();
	
	include "check.php";
	include_once "db_layer/DataStore.php";
    $accounts = $datastore->getMiAccounts();
    $user = $datastore->getUser($_SESSION['login']['id']);
    $total = 0;
    
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
					
                    <?php foreach($accounts as $key=>$account){ 
                        
                        $total = $total+$account->balance;
                        ?>
                        
                        <?php if($key %2){ ?>
                        <tr bgcolor="#DDD"><td><a href="view-account.php?accountNumber=<?php echo $account->accountNumber;?>"><?php echo $account->accountNumber; ?></a></td><td><?php echo $account->accountTypeName; ?></td><td>$<?php echo $account->balance;?></td></tr>
                        <?php }else{ ?>
                        <tr bgcolor="#CCC"><td><a href="view-account.php?accountNumber=<?php echo $account->accountNumber;?>"><?php echo $account->accountNumber; ?></a></td><td><?php echo $account->accountTypeName; ?></td><td>$<?php echo $account->balance;?></td></tr>
                        <?php } ?>
                        
                    <?php } ?>
                        <tr style="color:white; font-size:1.2em; font-weight:bold"><td></td><td>Total:</td><td>$<?php echo $total?></td></tr>
                        
                </table>
			</div><!--CLOSE CONTENT MAIN-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
