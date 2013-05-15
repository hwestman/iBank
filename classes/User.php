<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author hwestman
 */

require_once 'resources/Faker/src/autoload.php';
$faker = Faker\Factory::create();


class User {
    //put your code here
    
    var $login_id;
    var $full_name;
    var $pword;
    var $priv;
    var $contact_number;
    
    var $address_id;
    var $street_address;
    
    var $suburb_id;
    var $suburb_name;
    var $postcode;
    
    var $account;
    
    public function __construct($priv) {		//constructor
        
        /*
        global $faker;
        
        $this->full_name = $faker->name;
        $this->pword = $faker->word;
        $this->priv = $priv;
        $this->contact_number = $faker->phoneNumber;
        
        $this->street_address = $faker->address;
        $this->suburb_name = $faker->city;
        $this->postcode = $faker->randomNumber(1000, 9999);
        */
        
        
        
        
        
    }
}

?>
