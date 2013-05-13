<?php
session_start();
?>

<div id="header">
	<a href="index.php"><div class="logo"></div></a>
	<?php if($_SESSION['login']['cust'])
	{?>
	<div id='cssmenu'>
		<ul>
		   <li class='active'><a href="index.php"><span>Mi Accounts</span></a></li>
		   <li class='has-sub'><a href=''><span>View Accounts</span></a>
		      <ul>
		         <li><a href='view-account.php?type=1'><span>Savings</span></a></li>
		         <li><a href='view-account.php?type=2'><span>Cheque</span></a></li>
		         <li><a href='view-account.php?type=3'><span>Credit card</span></a></li>
		         <li class='last'><a href='view-account.php?type=4'><span>Loan</span></a></li>
		      </ul>
		   </li>
		   <li><a href='transfer.php'><span>Transfer</span></a></li>
		   <li><a href='update-details.php'><span>Update details</span></a></li>
		   <li class='last'><a href='log-out.php'><span>Log out</span></a></li>
		</ul>
	</div><!--CLOSE CSSMENU-->
	<?php
	}
	else if($_SESSION['login']['teller'])
	{?>
	<div id='cssmenu'>
		<ul>
			<li class="active"><a href=""><span>Teller</span></a></li>
		   <li><a href="index.php"><span>Mi Accounts</span></a></li>
		   <li class='has-sub'><a href=''><span>View Accounts</span></a>
		      <ul>
		         <li><a href='view-account.php?type=1'><span>Savings</span></a></li>
		         <li><a href='view-account.php?type=2'><span>Cheque</span></a></li>
		         <li><a href='view-account.php?type=3'><span>Credit card</span></a></li>
		         <li class='last'><a href='view-account.php?type=4'><span>Loan</span></a></li>
		      </ul>
		   </li>
		   <li><a href='update-users-details.php'><span>Update users details</span></a></li>
		   <li class='last'><a href='log-out.php'><span>Log out</span></a></li>
		</ul>
	</div><!--CLOSE CSSMENU-->
	<?php
	}
	else if($_SESSION['login']['manager'])
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
		   <li><a href='update-users-details.php'><span>Update users details</span></a></li>
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

