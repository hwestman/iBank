<?php


require_once 'resources/Faker/src/autoload.php';
include 'connection.php';
include 'User.php';

$connection = new Connection("ibank_dba","billybob");

$faker = Faker\Factory::create();

//for($i = 0;$i<1000;$i++){
/*    echo $faker->name;
    echo "</br>";
    echo $faker->address;
    echo "</br>";
    echo $faker->firstname;
    echo "</br>";
  */  
    
 //generatePostecode($connection->getConnection(),100);   
 generateUsers($connection->getConnection(),10);
 $connection->closeConnection();

function generatePostecode($con,$count){
    
    
    $query = "INSERT INTO ibank_dba.ibankSuburb (suburb_id,postcode,suburb_name) VALUES ('',:postCode,:suburbName)";
    
    // Parse the query.
    $stmt = \oci_parse($con, $query);
    global $faker;
    
    $error = null;
    
    for($i=0;$i<$count;$i++){
        // Bind the values. substrings postcode, to make sure its correct
        
        $pc = substr($faker->postcode,0,4);
        oci_bind_by_name($stmt, ':postCode', $faker->randomNumber(2000, 4999));
        oci_bind_by_name($stmt, ':suburbName', $faker->city);
        // Insert each record into the table.


        $res = oci_execute ($stmt);

        if(!$res){
            echo "Query not executed, it erred";
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            $error.=$e->message;
            
        }
    }
    
    oci_commit($stmt);
    oci_free_statement($stmt);
    
    
}

function generateSuburbs($count,$con){
   global $faker;
   
   $suburbs = Array();
   
   $query = "INSERT INTO ibank_dba.ibankSuburb (suburb_id,postcode,suburb_name) 
                    VALUES ('',:postCode,:suburbName) 
                    returning suburb_id into id";
    
   // Parse the query.
   $stmt = \oci_parse($con, $query);
   
   for($j=0;$j<100;$j++){
       
       
       for($t=0;$t<$faker->randomNumber(1,5);$t++){
            
            oci_bind_by_name($stmt, ':postCode', $faker->randomNumber(2000, 4999));
            oci_bind_by_name($stmt, ':suburbName', $faker->city);
            $res = oci_execute ($stmt);
            oci_commit($stmt);
            
            
            array_push($suburbs, array($faker->city,$j+1000,$id));
           
       }
   }
   return $suburbs;
}

function generateAddress($suburbs,$count,$con){
    global $faker;
    
    $addresses = Array();
    
    
    return $addresses;
    
}

function generateUsers($con,$count,$addresses){
   
    
   global $faker;
   
   $users = Array();
   
   
   for($i=0;$i<$count;$i++){
       
       array_push($users, new User(1));
       
   }
   
   foreach($users as $user){
       
       
       
   }
   
   
}

    
    
    //select sid,username,serial# from v$session where  = 'ibank_manager'
    
    //https://github.com/fzaninotto/Faker
    
    //postcode (substring to 4)
    
    //<dayOfMonth>13-<monthName>(sub4)nov-<substring 2-4>92
    
//};
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
