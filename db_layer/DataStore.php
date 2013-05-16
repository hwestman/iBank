<?php


include_once 'Connection.php';
//include 'User.php';
include 'classes/Account.php';
include 'classes/Transaction.php';
include 'classes/User.php';

class DataStore{
    
    var $connection;
    
    public function __construct() {		//constructor
        
        if(isset($_SESSION['login']['priv'])){
            $this->setConnection($_SESSION['login']['priv']);
        }else{
            if(isset($_GET['dba'])){
                $this->setConnection(3);    
            }else{
                $this->setConnection(1);
            }
            
        }
    }
    
    public function setConnection($priv){
        
        if($this->connection){
            $this->connection->closeConnection();
        }
        
        switch ($priv) {
            case 1:
                $this->connection = new Connection("ibank_customer","billybob");
                break;
            case 2:
                $this->connection = new Connection("ibank_teller","billybob");
                break;
            case 3:
                $this->connection = new Connection("ibank_manager","billybob");
                break;
            case 4:
                $this->connection = new Connection("ibank_dba","billybob");
                break;
        }
        
    }
    
    public function attemptLogin($username,$password){
        
        $retValue = null;
        $priv = null;
        
        
        $query = "  SELECT priv from ibank_dba.ibankUser U
                    WHERE U.login_id = :username
                    AND U.pword = :password";
                      
        
        $stmt = \oci_parse($this->connection->getConnection(), $query);

        //OCI_Define_By_Name($stmt,":username",$username); 
        //OCI_Define_By_Name($stmt,":password",$password); 
        oci_bind_by_name($stmt, ':username', $username);
        oci_bind_by_name($stmt, ':password', $password, 200);

        $res = oci_execute($stmt);
        
        if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $priv = $row['PRIV'];
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            
        }
        //oci_commit($stmt);
        oci_free_statement($stmt);
        
        if($priv && $priv != 1){
            $this->setConnection($priv);
        }
        
        return array('id'=>$username,'priv'=>$priv);
        
    }
    
    public function getMiAccounts(){
        
        $accounts = Array();
        $query = "  SELECT account_number,type_of_account,balance
                    FROM ibank_dba.ibankAccount A
                    WHERE A.login_user_id = :loginId";
                      
        
        $stmt = \oci_parse($this->connection->getConnection(), $query);

        oci_bind_by_name($stmt, ':loginId', $_SESSION['login']['id'], 8);

        $res = oci_execute($stmt);
        
        if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                
                
                $account = new Account($row['ACCOUNT_NUMBER'], $row['TYPE_OF_ACCOUNT'], $row['BALANCE']);
                array_push($accounts,$account);
                
                
                
            }

        }else{
            $accounts = null;
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            
        }
        //oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $accounts;
    }
    
    public function getAccount($accountNumber){
        
        $account = null;
        $query = "  SELECT account_number,type_of_account,balance
                    FROM ibank_dba.ibankAccount A
                    WHERE A.account_number = :accountNumber";
                
        
        $stmt = \oci_parse($this->connection->getConnection(), $query);

        oci_bind_by_name($stmt, ':accountNumber', $accountNumber, 8);

        $res = oci_execute($stmt);
        
        if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                
                
                $account = new Account($row['ACCOUNT_NUMBER'], $row['TYPE_OF_ACCOUNT'], $row['BALANCE']);
                
            }

        }else{
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            
        }
        //oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $account;
    }
    
    public function getUser($login_id){
        
        $user = null;
        $query = "  SELECT * 
                    FROM ibank_dba.user_info_view
                    WHERE login_id = :loginId";
                
        
        $stmt = \oci_parse($this->connection->getConnection(), $query);

        oci_bind_by_name($stmt, ':loginId', $login_id, 8);

        $res = oci_execute($stmt);
        
        if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $user = new User(   $row['LOGIN_ID'], 
                                    $row['FULL_NAME'], 
                                    $row['CONTACT_NUMBER'], 
                                    $row['STREET_ADDRESS'], 
                                    $row['SUBURB_NAME'], 
                                    $row['POSTCODE'],
                                    $row['COUNTY'],
                                    $row['SUBURB_ID'],
                                    $row['PWORD']); 
            }

        }else{
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            
        }
        //oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $user;
        
    }
    
    public function updateUser($user){
        
        $success = false;
        
        $query = "CALL ibank_dba.updateUser(:user_login,:full_name,:suburb_id,:contact_number,:password,:street_address)";
        
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    
        oci_bind_by_name($stmt, ':user_login', $user->login_id, 8);
        oci_bind_by_name($stmt, ':full_name', $user->full_name);
        oci_bind_by_name($stmt, ':suburb_id', $user->suburb_id, 11);
        oci_bind_by_name($stmt, ':contact_number', $user->contact_number);
        oci_bind_by_name($stmt, ':password', $user->new_password, 200);
        oci_bind_by_name($stmt, ':street_address', $user->street_address);
        
        
        $res = \oci_execute($stmt);
	    
        if($res){
            $success = true;
        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            echo $e['message'];
            exit;
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $success;
    }
    
    
    public function checkAccountNumber($account_number){
        
        $query = "  SELECT login_user_id
                    FROM ibank_dba.ibankUser U
                    LEFT JOIN ibank_dba.ibankAccount A
                    ON U.login_id = A.login_user_id
                    WHERE A.account_number = :accountNumber";
                      
        
        $stmt = \oci_parse($this->connection->getConnection(), $query);

        oci_bind_by_name($stmt, ':accountNumber', $account_number, 8);

        $res = oci_execute($stmt);
        $attemptUser = null;
        if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                
                
                $attemptUser = $row['LOGIN_USER_ID'];
            }

        }else{
            $attemptUser = null;
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            
        }
        //oci_commit($stmt);
        oci_free_statement($stmt);
        
        if(isset($attemptUser) && $attemptUser == $_SESSION['login']['id']){
            
            return true;
        }else{
            return false;
        }
    }
    
    public function getTransactions($accountNumber){
        
        
        if($this->checkAccountNumber($accountNumber)){
        
            $transactions = Array();
            $query = "  SELECT TT.transaction_id,TT.to_account,TT.date_of_transaction,TT.memo,TT.amount,A.login_user_id 
                        FROM ibank_dba.ibankTransaction TT 
                        LEFT JOIN ibank_dba.ibankAccount A on TT.from_account = A.account_number
                        WHERE TT.from_account = :account_number
                        ORDER BY TT.date_of_transaction DESC";


            $stmt = \oci_parse($this->connection->getConnection(), $query);

            oci_bind_by_name($stmt, ':account_number', $accountNumber, 8);

            $res = oci_execute($stmt);

            if($res){
                while ($row = oci_fetch_assoc($stmt)) {

                    $transaction = new Transaction($accountNumber,$row['TO_ACCOUNT'], $row['DATE_OF_TRANSACTION'], $row['TRANSACTION_ID'], $row['MEMO'], $row['AMOUNT']);
                    array_push($transactions,$transaction);
                }

            }else{
                $transactions = null;
                $e = oci_error($stmt);   // For oci_connect errors do not pass a handle

            }


            $query = "  SELECT TT.transaction_id,TT.from_account,TT.date_of_transaction,TT.memo,TT.amount,A.login_user_id 
                        FROM ibank_dba.ibankTransaction TT 
                        LEFT JOIN ibank_dba.ibankAccount A on TT.to_account = A.account_number
                        WHERE TT.to_account = :account_number";


            $stmt = \oci_parse($this->connection->getConnection(), $query);

            oci_bind_by_name($stmt, ':account_number', $accountNumber, 8);

            $res = oci_execute($stmt);

            if($res){
                while ($row = oci_fetch_assoc($stmt)) {

                    $transaction = new Transaction($row['FROM_ACCOUNT'],$accountNumber,$row['DATE_OF_TRANSACTION'], $row['TRANSACTION_ID'], $row['MEMO'], $row['AMOUNT']);
                    array_push($transactions,$transaction);
                }

            }else{
                $transactions = null;
                $e = oci_error($stmt);   // For oci_connect errors do not pass a handle

            }


            //oci_commit($stmt);
            oci_free_statement($stmt);
            
            
            function cmp($a, $b)
            {
                return strcmp($a->id, $b->id);
            }

            usort($transactions, "cmp");
            $transactions = array_reverse($transactions);
            return $transactions;
        }else{
            
            return false;
        }
        
        
        
        
    }
    
    public function getTransaction($transactionId){
        
            $query = "  SELECT * from ibank_dba.transaction_data_view 
                        WHERE transaction_id = :transactionId";
            $transaction = null;

            $stmt = \oci_parse($this->connection->getConnection(), $query);

            oci_bind_by_name($stmt, ':transactionId', $transactionId, 11);

            $res = oci_execute($stmt);
            
            if($res){
                while ($row = oci_fetch_assoc($stmt)) {
                    $transaction = new Transaction( $row['FROM_ACCOUNT'],
                                                    $row['TO_ACCOUNT'], 
                                                    $row['DATE_OF_TRANSACTION'], 
                                                    $row['TRANSACTION_ID'], 
                                                    $row['MEMO'], $row['AMOUNT'], 
                                                    $row['FULL_NAME_FROM'], 
                                                    $row['FULL_NAME_TO']);
                }

            }else{
                $transactions = null;
                $e = oci_error($stmt);   // For oci_connect errors do not pass a handle

            }
            return $transaction;
        
    }
    
    
    public function generateAustraliaPost(){
    
        $query = "INSERT INTO ibank_dba.ibankSuburb (suburb_id,postcode,suburb_name) 
                        VALUES ('',:postCode,:suburbName)";


        $stmt = \oci_parse($this->connection->getConnection(), $query);

        $file = file_get_contents('./resources/suburbs.txt', true);

        $data = explode("\n", $file);
        array_shift($data);
        foreach($data as $suburb){

            $sep = explode(",",$suburb);
            $sep[0]=str_replace('"', '', $sep[0]);
            $sep[1] = str_replace('"', '', $sep[1]);
            oci_bind_by_name($stmt, ':postCode', $sep[0], 4);
            oci_bind_by_name($stmt, ':suburbName', $sep[1]);

            $res = oci_execute($stmt);

            if(!$res){
                $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
                echo $e['message'];
                

            }


        }
        oci_commit($stmt);
        oci_free_statement($stmt);

    }

    public function getDynamicTable($query){

        $stmt = \oci_parse($this->connection->getConnection(), $query);

        $res = \oci_execute($stmt);

        if($res){
            echo "<table border='1'>\n";
            while ($row = oci_fetch_array($stmt, OCI_BOTH)) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
        }
        oci_free_statement($stmt);
        $this->closeConnection();
    }
    
    public function transferFunds($amount, $fromAccount, $toAccount, $memo) {
	    
	    $receiptNumber = null;

	    $query = "CALL ibank_dba.transferFunds($fromAccount, $toAccount, '$memo', $amount, :receiptNumber)";

	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    oci_bind_by_name($stmt, ":receiptNumber", $receiptNumber, 11);
	    $res = \oci_execute($stmt);
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $receiptNumber = $row['RECEIPTNUMBER'];
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        if($receiptNumber < 1 || $receiptNumber == null){
            return "Error";
        }
        else {
	        return $receiptNumber;
        }   
    }
    
    public function bankDeposit($amount, $fromAccount, $toAccount, $memo) {
	    
	    $receiptNumber = null;

	    $query = "CALL ibank_dba.bankDeposit($fromAccount, $toAccount, '$memo', $amount, :receiptNumber)";

	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    oci_bind_by_name($stmt, ":receiptNumber", $receiptNumber, 11);
	    $res = \oci_execute($stmt);
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $receiptNumber = $row['RECEIPTNUMBER'];
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        if($receiptNumber < 1 || $receiptNumber == null){
            return "Error";
        }
        else {
	        return $receiptNumber;
        }   
    }
    
    public function getInterestRate() {
	    $interestRate = array();
	    
	    $query = "SELECT interest_rate FROM ibank_dba.ibankAccountType";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    
	    $res = \oci_execute($stmt);
	    
	    $i = 0;
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $interestRate[$i] = $row['INTEREST_RATE'];
                $i++;
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $interestRate;
    }
    
    public function updateInterestRate($savings, $credit, $cheque, $loan) {
	    $interestRate = array();
	    
	    $query = "CALL ibank_dba.updateInterestRate($savings, $credit, $cheque, $loan)";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    $res = \oci_execute($stmt);
	    
	    $i = 0;
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $interestRate[$i] = $row['INTEREST_RATE'];
                $i++;
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $interestRate;
    }
    
    public function createAccountAndUser($accountType, $fullname, $address, $county, $suburbID, $contactNumber, $password, $staffID) {
	    /************************ CREATE USER **************************/
	    $loginID = null;
	    $userInfo = array();
	    $priv = 1;
	    
	    $query = "BEGIN ibank_dba.createUser(:suburbID, :address, :county, :fullname, :password, :priv, :contactNumber, :loginID); END;";
	    
	    //echo $query;
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    
	    oci_bind_by_name($stmt, ':suburbID', $suburbID, 11);
	    oci_bind_by_name($stmt, ':address', $address);
        oci_bind_by_name($stmt, ':county', $county);
        oci_bind_by_name($stmt, ':fullname', $fullname);
        oci_bind_by_name($stmt, ':password', $password, 200);
        oci_bind_by_name($stmt, ':priv', $priv);
        oci_bind_by_name($stmt, ':contactNumber', $contactNumber, 10);
        oci_bind_by_name($stmt, ':loginID', $loginID, 8);
	    
	    $res = \oci_execute($stmt);

	    if($res){
		     $userInfo[0] = $loginID;
        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        /************************ CREATE ACCOUNT **************************/
        $accountNumber = null;
                
        $query2 = "CALL ibank_dba.createAccount(:staffID, :loginID, :accountType, :accountNumber)";
        
        $stmt2 = \oci_parse($this->connection->getConnection(), $query2);
        
        oci_bind_by_name($stmt2, ':staffID', $staffID, 8);
	    oci_bind_by_name($stmt2, ':loginID', $loginID, 8);
        oci_bind_by_name($stmt2, ':accountType', $accountType);
        oci_bind_by_name($stmt2, ':accountNumber', $accountNumber, 8);
        
	    $res2 = \oci_execute($stmt2);

	    if($res2){
	    	$userInfo[1] = $accountNumber;
        }else{
            $e2 = oci_error($stmt2);   // For oci_connect errors do not pass a handle
        }
        
        oci_commit($stmt2);
        oci_free_statement($stmt2);
       
        return $userInfo;
    }
    
    public function getSuburbs($postcode){
        $suburbs = array();
        $query = "select * from ibank_dba.ibankSuburb
                    WHERE postcode = $postcode";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    $res = \oci_execute($stmt);
	    
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                array_push($suburbs,array('id'=>$row['SUBURB_ID'],'suburb'=>$row['SUBURB_NAME'],'postcode'=>$row['POSTCODE']));
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $suburbs;
    }
    public function getInterest($accountType){
        
        $query = "SELECT interest_rate from ibank_dba.ibankAccountType
                    WHERE type_id = :accountType";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
        
        oci_bind_by_name($stmt, ':accountType', $accountType);
        
	    $res = \oci_execute($stmt);
	    
	    $interest = null;
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $interest = array('type'=>$accountType,'rate'=>$row['INTEREST_RATE']);
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $interest;
        
        
    }
     public function getAccumulated($accountNumber){
        
        $query = "SELECT interest_sum from ibank_dba.ibankAccount
                    WHERE account_number = :accountnumber";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
        
        oci_bind_by_name($stmt, ':accountNumber', $accountNumber);
        
	    $res = \oci_execute($stmt);
	    
	    $interest = null;
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $interest = $row['INTEREST_SUM'];
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            echo $e['message'];
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $interest;
        
        
    }
    
    public function savings(){
    	$savings = array();
	    $query = "SELECT SUM(balance), SUM(interest_sum) FROM ibank_dba.ibankAccount WHERE type_of_account = 1";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    $res = \oci_execute($stmt);
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                array_push($savings,array('balance'=>$row['SUM(BALANCE)'],'interestSum'=>$row['SUM(INTEREST_SUM)']));
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $savings;
    }
    
    public function credit(){
	    $credit = array();
	    $query = "SELECT SUM(balance), SUM(interest_sum) FROM ibank_dba.ibankAccount WHERE type_of_account = 2";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    $res = \oci_execute($stmt);
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                array_push($credit,array('balance'=>$row['SUM(BALANCE)'],'interestSum'=>$row['SUM(INTEREST_SUM)']));
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $credit;
    }
    
    public function cheque(){
	    $cheque = array();
	    $query = "SELECT SUM(balance), SUM(interest_sum) FROM ibank_dba.ibankAccount WHERE type_of_account = 3";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    $res = \oci_execute($stmt);
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                array_push($cheque,array('balance'=>$row['SUM(BALANCE)'],'interestSum'=>$row['SUM(INTEREST_SUM)']));
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $cheque;
    }
    
    public function loan(){
	    $loan = array();
	    $query = "SELECT SUM(balance), SUM(interest_sum) FROM ibank_dba.ibankAccount WHERE type_of_account = 4";
	    
	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    $res = \oci_execute($stmt);
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                array_push($loan,array('balance'=>$row['SUM(BALANCE)'],'interestSum'=>$row['SUM(INTEREST_SUM)']));
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        oci_commit($stmt);
        oci_free_statement($stmt);
        
        return $loan;
    }
    
    public function accumulateInterest(){
    	$query = "CALL ibank_dba.accumulateInterest(:accumulatedInterest)";
    	
    	$stmt = \oci_parse($this->connection->getConnection(), $query);
        
        oci_bind_by_name($stmt, ':accumulatedInterest', $interest);
        
	    $res = \oci_execute($stmt);

	    if($res){
	    	return true;
        }else{
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            return false;
        }
        
        oci_commit($stmt);
        oci_free_statement($stmt);
    }
    
    public function payoutInterest(){
    	$query = "CALL ibank_dba.payoutInterest(:interestSum)";
    	
    	$stmt = \oci_parse($this->connection->getConnection(), $query);
        
        oci_bind_by_name($stmt, ':interestSum', $interest);
        
	    $res = \oci_execute($stmt);

	    if($res){
	    	return true;
        }else{
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            return false;
        }
        
        oci_commit($stmt);
        oci_free_statement($stmt);
    }
    
}
$datastore = new DataStore();

?>
