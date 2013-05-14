<?php
class Connection {
    
    var $connection = null;
    
    public function __construct($userName,$password) {		//constructor
        
        
        $description = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dwarf.cit.griffith.edu.au)(PORT = 1526)))(CONNECT_DATA =(SID = DBS)(SERVER = DEDICATED)))";
      
        
        $this->connection = OCILogon($userName,$password,$description);
   
    }
    public function getConnection(){
        return $this->connection;
        
    }
    public function parseStatement($query){
        
        $stmt = OCIParse($this->connection,$query); 
        $res = oci_execute($stmt);
        
        if(!$res){
            echo "Query not executed, it erred";
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            var_dump($e);
            
        }
        
        
        
        return $res;
    }
    public function parseFile($file){
        //$content = file_get_contents($file);
        $content = "DROP TABLE users;CREATE TABLE users(login_id number(11) PRIMARY KEY,full_name varchar2(50),address_id number(11),pword varchar2(200),priv number(1),contact_number number(10))";
        $stmt = OCIParse($this->connection,$content);     
        $res = oci_execute($stmt);
        
        if(!$res){
            echo "Query not executed, it erred";
            $e = oci_error($stmt);   // For oci_connect errors do not pass a handle
            var_dump($e);
            
        }
        oci_commit($stmt);
        
        $e = $stmt;
        
    }
    public function closeConnection(){
        OCILogoff($this->connection);
    }
    
}




