<?php
    //this needs all required files

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Login - iBank</title>
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
			<div class="login">
				<form method="post" action="login().php" name="login">
					<table>
						<tr><td>User ID:</td><td><input name="username" class="left" id="username" type="text" size="30"/></td></tr>
						<tr><td>Password:</td><td><input name="password" class="left" id="password" type="password" size="30"/></td></tr>
					</table>
						<input type="reset" class="button" id="left" value="Cancel" name="Cancel"/>
						<input type="submit" class="button" id="right" value="Login" name="login"/>
				</form>
			</div><!--CLOSE LOGIN-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>

