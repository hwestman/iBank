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

class User {
    //put your code here
    
    var $login_id;
    var $full_name;
    var $priv;
    var $contact_number;

    var $address_id;
    var $street_address;
    var $county;
    var $suburb_id;
    var $suburb_name;
    var $postcode;
    
    var $account;
    var $new_password;
    
    public function __construct($login_id,$full_name,$contact_number,$street_address,$suburb_name,$postcode,$county,$suburb_id,$password) {		//constructor
        
        $this->login_id = $login_id;
        $this->full_name = $full_name;
        $this->contact_number = $contact_number;
        $this->street_address = $street_address;
        $this->suburb_name = $suburb_name;
        $this->postcode = $postcode;
        $this->county = $county;
        $this->suburb_id = $suburb_id;
        $this->new_password = $password;
        
    }
}

?>
