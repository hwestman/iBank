<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of account
 *
 * @author hwestman
 */
class Account {
    //put your code here
    
    
    var $accountNumber;
    var $accountType;
    var $accountTypeName;
    var $balance;
    
    /**
     * 
     * @param type $an accountnumber
     * @param type $at accounttype
     * @param type $b balance
     */
    public function __construct($accountNumber,$accountType,$balance) {		//constructor
        $this->accountNumber = $accountNumber;
        $this->accountType = $accountType;
        
        $this->balance = $balance;
        
        switch ($accountType) {
            case 1:
                $this->accountTypeName = 'Savings';
                break;
            case 2:
                $this->accountTypeName = 'Credit';
                break;
            case 3:
                $this->accountTypeName = 'Cheque';
                break;
            case 4:
                $this->accountTypeName = 'Loan';
                break;
        }
    }
    
    
}

?>
