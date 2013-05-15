<?php


include 'Connection.php';
//include 'User.php';
include 'classes/Account.php';
include 'classes/Transaction.php';

class DataStore{
    
    var $connection;
    
    public function __construct() {		//constructor
    
        if(isset($_SESSION['login']['priv'])){
            $this->setConnection($_SESSION['login']['priv']);
        }else{
            $this->setConnection(1);
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
        oci_bind_by_name($stmt, ':password', $password);

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

        oci_bind_by_name($stmt, ':loginId', $_SESSION['login']['id']);

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
    
    public function checkAccountNumber($account_number){
        
        $query = "  SELECT login_user_id
                    FROM ibank_dba.ibankUser U
                    LEFT JOIN ibank_dba.ibankAccount A
                    ON U.login_id = A.login_user_id
                    WHERE A.account_number = :accountNumber";
                      
        
        $stmt = \oci_parse($this->connection->getConnection(), $query);

        oci_bind_by_name($stmt, ':accountNumber', $account_number);

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
                        WHERE TT.from_account = :account_number";


            $stmt = \oci_parse($this->connection->getConnection(), $query);

            oci_bind_by_name($stmt, ':account_number', $accountNumber);

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

            oci_bind_by_name($stmt, ':account_number', $accountNumber);

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
            
            return $transactions;
        }else{
            
            return false;
        }
        
        
        
        
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
            oci_bind_by_name($stmt, ':postCode', $sep[0]);
            oci_bind_by_name($stmt, ':suburbName', $sep[1]);

            $res = oci_execute($stmt);

            if(!$res){
                echo "Query not executed, it erred";
                $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
                echo $e->message;

            }


        }
        //oci_commit($stmt);
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

	    $query = "BEGIN transferFunds($fromAccount, $toAccount, '$memo', $amount, :receiptNumber); END;";

	    $stmt = \oci_parse($this->connection->getConnection(), $query);
	    oci_bind_by_name($stmt, ":receiptNumber", $receiptNumber);
	    $res = \oci_execute($stmt);
	    
	    if($res){
            while ($row = oci_fetch_assoc($stmt)) {
                $receiptNumber = $row['RECEIPTNUMBER'];
            }

        }else{
            
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
        }
        
        oci_free_statement($stmt);
        
        if($receiptNumber < 1 || $receiptNumber == null){
            return "Error";
        }
        else {
	        return $receiptNumber;
        }   
    }

    
    
}
$datastore = new DataStore();

?>
