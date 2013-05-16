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
    var $from;
    var $to;
    var $fromUser;
    var $toUser;
    
    /**
     * 
     * @param type $d date
     * @param type $i id
     * @param type $m memo
     * @param type $a amount
     * @param type $b balance
     */
    public function __construct($from,$to,$date,$id,$memo,$amount,$fromUser,$toUser) {		//constructor
        $this->from = $from;
        $this->to = $to;
        $this->fromUser = $fromUser;
        $this->toUser = $toUser;
        $this->date = $date;
        $this->id = $id;
        $this->memo = $memo;
        $this->amount = $amount;
    }
}

?>
