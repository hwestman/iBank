<?php
    //this needs all required files

    session_start();
    
    include_once "db_layer/DataStore.php";
    $user = $datastore->getUser($_SESSION['login']['id']);
    
    if(isset($_POST['Update'])){
        
        if($_POST['fName'] != ''){
            $user->full_name = $_POST['fName'];
        }
        if($_POST['address'] != ''){
            $user->street_address = $_POST['address'];
        }
        if($_POST['suburb'] != ''){
            $user->suburb_id = $_POST['suburb'];
        }
        if($_POST['telephone'] != ''){
            $user->contact_number = $_POST['telephone'];
        }
        if($_POST['county'] != ''){
            $user->county = $_POST['county'];
        }
        if($_POST['password'] != ''){
            $user->new_password = $_POST['password'];
        }
        $success = $datastore->updateUser($user);
        if($success){
            header('LOCATION: update-details.php');
        }else{
            /*Do something preventive*/
        }
        
    }
    
    
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>
	    <title>Update details - iBank</title>
	    <meta charset="UTF-8"/>
	    <link rel="stylesheet" type="text/css" href="css/style.css" />
	    <link rel="stylesheet" type="text/css" href="css/menu.css" />
	    <link rel="stylesheet" type="text/css" href="css/button.css" />
        
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="js/onload.js" type="text/javascript"></script>
        
	</head>

	<div id="container">
		<?php include "include/header.php"; ?>
		<div id="content">
			<div id="content-main">
				<form name="update" method="post" action="<?php $_SERVER['php_self'] ?>">
						<table>
							<tr><td>Full name:</td><td><input class="left" name="fName" id="fName" type="text" placeholder="<?php echo $user->full_name ?>" maxlength="50" size="50"/></td></tr>
							<tr><td>Address:</td><td><input class="left" name="address" id="address" type="text" placeholder="<?php echo $user->street_address ?>" maxlength="200" size="50"/></td></tr>
                            
                            <tr>
                                <td>Suburb</td>
                                <td><input class="left" name="suburb" id="suburb2" type="tel" placeholder="<?php echo $user->suburb_name ?>"   /><input class="left" name="postcode" id="postcode2" type="tel" readonly="readonly" placeholder="<?php echo $user->postcode ?>"  maxlength="4" size="10" /><input name="suburb" id="suburb_id" hidden="hidden"/> </td>
                                
                            </tr>
                            <tr><td>County/State:</td><td><input class="left" name="county" id="county" type="text" placeholder="<?php echo $user->county ?>" maxlength="200" size="50"/></td></tr>
							<tr><td>Contact number:</td><td><input class="left" name="telephone" id="telephone" type="tel" placeholder="<?php echo $user->contact_number ?>" maxlength="10" size="20"/></td></tr>
							<tr><td>Current password:</td><td><input class="left" name="password" id="password" type="password" placeholder="enter current password to make changes" maxlength="50" size="50"/></td></tr>
							<tr><td></td></tr>
							<tr><td>New password:</td><td><input class="left password" name="newPassword" id="newPassword" type="password" maxlength="50" size="50" placeholder="leave blank if no change to password"/><div class="error"></div></td></tr>
							<tr><td>Confirm new password:</td><td><input class="left" name="confirmPassword" id="confirmPassword" type="password" size="50" maxlength="50"  placeholder="leave blank if no change to password"/><div class="error"></div></td></tr>
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
