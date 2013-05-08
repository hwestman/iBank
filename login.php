<?php
    //this needs all required files

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Login - iBank</title>
	    <meta charset="UTF-8"/>
	    <link rel="stylesheet" type="text/css" href="css/style.css" />
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	</head>

	<div id="container">
		<?php include "include/header.php"; ?>
		<div id="content">
			<div class="login">
				<form method="post" action="login().php" name="login">
					<table>
						<tr><td>User ID:</td><td><input name="username" id="username" type="text" size="30"/></td></tr>
						<tr><td>Password:</td><td><input name="password" id="password" type="password" size="30"/></td></tr>
						<tr><td><input type="submit" value="cancel" name="cancel"/></td><td style="float: right"><input type="submit" value="Login" name="login"/>
					</table>
				</form>
			</div><!-- CLOSE LOGIN -->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
