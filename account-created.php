<?php
    session_start();
    
    include "db_layer/DataStore.php";
    
    if(isset($_POST['Print']))
    {
    	unset($_SESSION['newAccount']);
	    header('LOCATION: teller.php');
    }
    else if(isset($_POST['Done']))
    {
    	unset($_SESSION['newAccount']);
	    header('LOCATION: teller.php');
    }
    
	$staffID = $_SESSION['login']['id'];
	
	$accountType = $_POST['accountType'];
	$fullname = $_POST['fName'];
	$address = $_POST['address'];
	$county = $_POST['county'];
	$suburbID = $_POST['suburb'];
	$contactNumber = $_POST['telephone'];
	$password = $_POST['password'];
	
	if($_POST['existing']){
		$loginID = $_POST['existing'];
		
		$userInfo = $datastore->createAccount($staffID, $loginID, $accountType);
	}
	else{
		$userInfo = $datastore->createAccountAndUser($accountType, $fullname, $address, $county, $suburbID, $contactNumber, $password, $staffID);
	}
	
    
	    $_SESSION['newAccount'][0] = $userInfo[0];
	    $_SESSION['newAccount'][1] = $password;
	    $_SESSION['newAccount'][2] = $userInfo[1];
?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>New account created - iBank</title>
	    <meta charset="UTF-8"/>
	    <link rel="stylesheet" type="text/css" href="css/style.css" />
	    <link rel="stylesheet" type="text/css" href="css/menu.css" />
	    <link rel="stylesheet" type="text/css" href="css/button.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <script src="js/onload.js" type="text/javascript"></script>
	</head>

	<div id="container">
		<?php include "include/header.php"; ?>
		<div id="content">
			<div id="content-main">
				<form name="transfer-done" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<table>
						<tr><td class="left">Login number:</td><td><?php echo $_SESSION['newAccount'][0] ?></td></tr>
						<tr><td class="left">Password:</td><td><?php echo $_SESSION['newAccount'][1]?></td></tr>
						<tr><td class="left">Bank account number:</td><td><?php echo $_SESSION['newAccount'][2] ?></td></tr>
					</table>
					<input type="submit" class="button" onClick="window.print()" id="left" name="Print" value="Print">
					<input type="submit" class="button" id="right" name="Done" value="Done">
				</form>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				**Caution image**<br/>
				Keep it secret, keep it safe.
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
