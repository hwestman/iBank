<?php
    //this needs all required files


    include_once '';


?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Update details - iBank</title>
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
				<form name="update" method="post" action="<?php $_SERVER['php_self'] ?>">
						<table>
							<tr><td>Full name:</td><td><input class="left" name="fName" id="fName" type="text" placeholder="dynamic driven" maxlength="50" size="50"/></td></tr>
							<tr><td>Address:</td><td><input class="left" name="address" id="address" type="text" placeholder="dynamic driven" maxlength="200" size="50"/></td></tr>
							<tr><td>Suburb:</td><td><input class="left" name="suburb" id="suburb" type="text" placeholder="dynamic driven drop down" maxlength="30" size="30" /> <input class="left" name="postcode" id="postcode" type="tel" placeholder="dynamic driven" readonly="readonly" maxlength="4" size="10" /></td></tr>
							<tr><td>Contact number:</td><td><input class="left" name="telephone" id="telephone" type="tel" placeholder="dynamic driven" maxlength="10" size="20"/></td></tr>
							<tr><td>Current password:</td><td><input class="left" name="password" id="password" type="password" placeholder="enter current password to make changes" maxlength="50" size="50"/></td></tr>
							<tr><td></td></tr>
							<tr><td>New password:</td><td><input class="left" name="newPassword" id="newPassword" type="password" maxlength="50" size="50" required placeholder="leave blank if no change to password"/></td></tr>
							<tr><td>Confirm new password:</td><td><input class="left" name="confirmPassword" id="confirmPassword" type="password" size="50" maxlength="50" required placeholder="leave blank if no change to password"/></td></tr>
						</table>
					<input type="submit" class="button" id="left" name="Cancel" value="Cancel">
					<input type="submit" class="button" id="right" name="Update" value="Update">
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
