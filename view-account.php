<?php
    //this needs all required files

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>iBank</title>
	    <meta charset="UTF-8"/>
	    <link rel="stylesheet" type="text/css" href="css/style.css" />
	    <link rel="stylesheet" type="text/css" href="css/menu.css" />
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	    <script src="js/onload.js" type="text/javascript"></script>
	</head>

	<div id="container">
		<?php include "include/header.php"; ?>
		<div id="content">
			<form name="update" method="post" action="#"
			<div class="update-details">
				<table>
					<tr><td>Full name:</td><td><input name="fName" id="fName" type="text" maxlength="50" size="50"/></td></tr>
					<tr><td>Address:</td><td><input name="address" id="address" type="text" maxlength="200" size="50"/></td></tr>
					<tr><td>Post code:</td><td><input name="postcode" id="postcode" type="tel" maxlength="4" size="10" /></td></tr>
					<tr><td>Contact number:</td><td><input name="telephone" id="telephone" type="tel" maxlength="10" size="20"/></td></tr>
					<tr><td><hr></td><td><hr></td></tr>
					<tr><td>Current password:</td><td><input name="password" id="password" type="password" maxlength="50" size="50"/></td></tr>
				</table>
			</div><!-- CLOSE UPDATE DETAILS -->
			<div class="update-password">
				<table>
					<tr><td>New password:</td><td><input name="newPassword" id="newPassword" type="password" maxlength="50" size="50" required placeholder="leave blank if no change"/></td></tr>
					<tr><td>Confirm new password:</td><td><input name="confirmPassword" id="confirmPassword" type="password" size="50" maxlength="50" required placeholder="leave blank if no change"/><div class="caption"></div></td></tr>
				</table>
			</div><!--CLOSE UPDATE PASSWORD -->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
