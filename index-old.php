<?php
    $i = "hallvard";
    $j = 4;
    $k = 6;
    $l = $k+$j;

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <title>iBank</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="/iBank/css/style.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
     
    
</head>
        <body>
            <h1>iBank</h1>
            <form name="credentialForm" id="credentialForm" action="#" method="post"> 
		<label for="username">Username:</label> 
		<input class="reqVal" type="text" name="username" id="username" required placeholder="Username" />
                <i class="errorMessage"></i>
                
                <label for="password">Password:</label> 
		<input class="reqVal" type="password" name="password" id="password" required placeholder="Password" />
                <i class="errorMessage"></i>
                
                <input name="reset" type="button" value="Reset" />
		<input name="submit" type="submit" value="Submit" disabled="disabled"/>
            </form>
            
           <script type="text/javascript" src="/iBank/js/onload.js"></script>
            
        </body>
</html>
