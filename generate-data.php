<?php


require_once 'resources/Faker/src/autoload.php';
$faker = Faker\Factory::create();

//for($i = 0;$i<1000;$i++){
    echo $faker->name;
    echo "</br>";
    echo $faker->address;
    echo "</br>";
    echo $faker->firstname;
    echo "</br>";
    
//};
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
