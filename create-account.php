<?php
    session_start();
    
    include "db_layer/DataStore.php";
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
        <script type="text/javascript">
			function validateForm()
			{
				var existing=document.forms["newUser"]["existing"].value;
				var account=document.forms["newUser"]["accountType"].value;
				var fname=document.forms["newUser"]["fName"].value;
				var address=document.forms["newUser"]["address"].value;
				var suburb=document.forms["newUser"]["suburb2"].value;
				var county=document.forms["newUser"]["county"].value;
				var password=document.forms["newUser"]["password"].value;
				
				if(existing)
				{
					return true;
				}
				if (account==null || account=="")
				{
					alert("A type of account must be chosen");
					return false;
				}
				else if (fname==null || fname=="")
				{
					alert("Full name must be filled out");
					return false;
				}
				else if (address==null || address=="")
				{
					alert("Address must be filled out");
					return false;
				}
				else if (suburb2==null || suburb2=="")
				{
					alert("Suburb and post code must be selected");
					return false;
				}
				else if (county==null || county=="")
				{
					alert("County/State must be filled out");
					return false;
				}
				else
				{
					return true;
				}
			}
			
			function checkPasswordsMatch()
			{						
				var password1 = document.getElementById('pass1');
				var password2 = document.getElementById('pass2');
				
				if (password1.value == password2.value)
				{
					document.forms["password"].submit();
					return true;
				} 
				else 
				{
				    alert('Passwords don\'t match');
				    return false;
				}
			}
		</script>
	</head>

	<div id="container">
		<?php include "include/header.php"; ?>
		<div id="content">
			<div id="content-main">
				<form name="newUser" method="post" action="account-created.php">
					<table>
						<tr><td>Bank account type:</td><td>
						<select name="accountType">
							<option name="Choose account type" value="" selected="selected">Choose account type</option>
							<option name="Savings" value="1">Savings</option>
							<option name="Credit" value="2">Credit</option>
							<option name="Cheque" value="3">Cheque</option>
							<option name="Loan" value="4">Loan</option>
						</select>
						<tr><td>Existing users login number:</td><td><input class="left" name="existing" id="existing" type="text" placeholder="Leave blank if a new user" maxlength="50" size="50"/></td></tr>
						<tr><td>Full name:</td><td><input class="left" name="fName" id="fName" type="text" placeholder="Full name" maxlength="50" size="50"/></td></tr>
						<tr><td>Address:</td><td><input class="left" name="address" id="address" type="text" placeholder="Street address" maxlength="200" size="50"/></td></tr>
						<tr>
                                <td>Suburb</td>
                                <td><input class="left" name="suburb" id="suburb2" type="tel" placeholder="<?php echo $user->suburb_name ?>"   /><input class="left" name="postcode" id="postcode2" type="tel" readonly="readonly" placeholder="<?php echo $user->postcode ?>"  maxlength="4" size="10" /><input name="suburb" id="suburb_id" hidden="hidden"/> </td>
                                
                            </tr>
						<tr><td>County/State:</td><td><input class="left" name="county" id="county" type="tel" placeholder="County/State" maxlength="50" size="50"/></td></tr>
						<tr><td>Contact number:</td><td><input class="left" name="telephone" id="telephone" type="tel" placeholder="Contact telephone number" maxlength="10" size="30"/></td></tr>
                        <tr><td>Password:</td><td><input class="left" type="password" name="password" id="newPassword" size="50" maxlength="30" required placeholder="Password minimum 8 characters"/><div class="error"></div></td></tr>
						<tr><td>Re-type Password:</td><td><input class="left" type="password" name="re_newPassword" id="confirmPassword" size="50" maxlength="30" required placeholder="Confirm password"/><div class="error"></div></td></tr>
					</table>
					<input type="submit" class="button" id="left" name="Cancel" value="Cancel"/>
					<input type="submit" class="button" id="right" name="Create" value="Create" onclick="javascript:return validateForm()"/>
				</form>
			</div><!--CLOSE CONTENT MAIN-->
			<div id="content-right">
				**Caution image**<br/>
				Make sure these details are correct before proceeding.
			</div><!--CLOSE CONTENT RIGHT-->
		</div><!-- CLOSE CONTENT -->
		<?php include "include/footer.php"; ?>
	</div><!-- CLOSE CONTAINER -->
</html>
