<?php


include 'Connection.php';
//include 'User.php';
include 'classes/Account.php';

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

    
    
}
$datastore = new DataStore();

?>