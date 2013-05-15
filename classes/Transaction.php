<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transaction
 *
 * @author hwestman
 */
class Transaction {
    
    var $date;
    var $id;
    var $memo;
    var $amount;
    var $balance;
    
    /**
     * 
     * @param type $d date
     * @param type $i id
     * @param type $m memo
     * @param type $a amount
     * @param type $b balance
     */
    public function __construct($date,$id,$memo,$amount,$balance) {		//constructor
        $this->date = $date;
        $this->id = $id;
        $this->memo = $memo;
        $this->amount = $amount;
        $this->balance = $balance;
    }
}

?>
