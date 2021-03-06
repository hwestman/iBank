<?php
session_start();
include_once "db_layer/DataStore.php";
$accounts = $datastore->getMiAccounts();

?>

<div id="header">
	<a href="mibank.php"><div class="logo"></div></a>
	<?php if($_SESSION['login']['priv'] == 1)
	{?>
	<div id='cssmenu'>
		<ul>
		   <li class='active'><a href="mibank.php"><span>Mi Accounts</span></a></li>
		   <li class='has-sub'><a href=''><span>View Accounts</span></a>
		      <ul>
                  <?php foreach($accounts as $account){ ?>
                    <li class='last'><a href='view-account.php?accountNumber=<?php echo $account->accountNumber;?>'><span><?php echo $account->accountTypeName.' ('.$account->accountNumber.')'; ?></span></a></li>
                <?php } ?>
              </ul>
		   </li>
		   <li><a href='transfer.php'><span>Transfer</span></a></li>
		   <li><a href='update-details.php'><span>Update details</span></a></li>
		   <li class='last'><a href='log-out.php'><span>Log out</span></a></li>
		</ul>
	</div><!--CLOSE CSSMENU-->
	<?php
	}
	else if($_SESSION['login']['priv'] == 2)
	{?>
	<div id='cssmenu'>
		<div class="teller">
		<ul>
			<li class="active"><a href="teller.php"><span>Teller</span></a></li>
		   <li><a href="create-account.php"><span>New account</span></a></li>
		   <li class='last'><a href='log-out.php'><span>Log out</span></a></li>
		</ul>
		</div><!--CLOSE TELLER -->
	</div><!--CLOSE CSSMENU-->
	<?php
	}
	else if($_SESSION['login']['priv'] == 3)
	{?>
	<div id='cssmenu'>
		<div class="manager">
		<ul>
			<li class="active"><a href="manager.php"><span>Manager</span></a></li>
			<li><a href="schedule/accumulate-interest.php"><span>Accumulate interest</span></a></li>
			<li><a href="schedule/payout-interest.php"><span>Payout interest</span></a></li>
		   <li class='last'><a href='log-out.php'><span>Log out</span></a></li>
		</ul>
		</div><!-- CLOSE MANAGER -->
	</div><!--CLOSE CSSMENU-->
	<?php
	}
	else
	{
	?>
		<div id='cssmenu'>
			<ul>
			   <li class='active'><a href='login.php'><span>Login</span></a></li>
			</ul>
		</div>
	<?php
	}
	?>
</div><!-- CLOSE HEADER -->

