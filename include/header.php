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
                    <li class='last'><a href='view-account.php?accountNumber=<?php echo $account->accountNumber;?>'><span><?php echo $account->accountTypeName ?></span></a></li>
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
		<ul>
			<li class="active"><a href=""><span>Teller</span></a></li>
		   
		   <li class='last'><a href='log-out.php'><span>Log out</span></a></li>
		</ul>
	</div><!--CLOSE CSSMENU-->
	<?php
	}
	else if($_SESSION['login']['priv'] == 3)
	{?>
	<div id='cssmenu'>
		<ul>
			<li class="active"><a href=""><span>Manager</span></a></li>
			<li class='has-sub'><a href=''><span>Reporting</span></a>
		      <ul>
		         <li><a href='view-account.php?type=1'><span>Savings</span></a></li>
		         <li><a href='view-account.php?type=2'><span>Cheque</span></a></li>
		         <li><a href='view-account.php?type=3'><span>Credit card</span></a></li>
		         <li class='last'><a href='view-account.php?type=4'><span>Loan</span></a></li>
		      </ul>
		   </li>
		   <li><a href='interest-rate.php'><span>Interest rate</span></a></li>
		   <li class='last'><a href='log-out.php'><span>Log out</span></a></li>
		</ul>
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

