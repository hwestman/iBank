<?php
    session_start();
    
    include "db_layer/DataStore.php";
    
    if(isset($_POST['Create'])){
    	echo $staffID = $_SESSION['login']['id'];
    	
    	echo $accountType = $_POST['accountType'];
    	echo $fullname = $_POST['fName'];
    	echo $address = $_POST['address'];
    	echo $county = $_POST['county'];
    	echo $suburbID = 4;
    	echo $contactNumber = $_POST['telephone'];
    	echo $password = $_POST['newPassword'];
    	
    	$userInfo = $datastore->createAccountAndUser($accountType, $fullname, $address, $county, $suburbID, $contactNumber, $password, $staffID);
    	
        /* $userInfo = $datastore->createAccountAndUser($accountType, $fullname, $address, $suburbID, $contactNumber, $password, $staffID); */
        
        echo "<br/>". $userInfo[0]. " " .$userInfo[1];
    }
    
    
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>New account - iBank</title>
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
				<form name="update" method="post" action="<?php $_SERVER['php_self'] ?>">
						<table>
							<tr><td>Bank account type:</td><td>
							<select name="accountType">
								<option name="Choose account type" value="">Choose account type</option>
								<option name="Savings" value="1">Savings</option>
								<option name="Credit" value="2">Credit</option>
								<option name="Cheque" value="3">Cheque</option>
								<option name="Loan" value="4">Loan</option>
							</select>
							<tr><td>Full name:</td><td><input class="left" name="fName" id="fName" type="text" placeholder="Full name" maxlength="50" size="50"/></td></tr>
							<tr><td>Address:</td><td><input class="left" name="address" id="address" type="text" placeholder="Street address" maxlength="200" size="50"/></td></tr>
							<tr><td>Suburb:</td><td><input class="left" name="suburb" id="suburb" type="text" placeholder="Suburb" maxlength="30" size="30" /> <input class="left" name="postcode" id="postcode" type="tel" placeholder="dynamic driven" readonly="readonly" maxlength="4" size="10" /></td></tr>
							<tr><td>County/State:</td><td><input class="left" name="county" id="county" type="tel" placeholder="County/State" maxlength="50" size="50"/></td></tr>
							<tr><td>Contact number:</td><td><input class="left" name="telephone" id="telephone" type="tel" placeholder="Contact telephone number" maxlength="10" size="20"/></td></tr>
							<tr><td>Password:</td><td><input class="left" name="newPassword" id="newPassword" type="password" maxlength="50" size="50" required placeholder="Password minimum 8 characters"/></td></tr>
							<tr><td>Confirm password:</td><td><input class="left" name="confirmPassword" id="confirmPassword" type="password" size="50" maxlength="50" required placeholder="Confirm password"/></td></tr>
						</table>
					<input type="submit" class="button" id="left" name="Cancel" value="Cancel">
					<input type="submit" class="button" id="right" name="Create" value="Create">
				</form>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				**Caution image**<br/>
				Make sure your details are always current and up-to-date.
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
