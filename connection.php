<?php
class Connection {
    
    var $connection = null;
    
    public function __construct() {		//constructor
        
        
        $description = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dwarf.cit.griffith.edu.au)(PORT = 1526)))(CONNECT_DATA =(SID = DBS)(SERVER = DEDICATED)))";
        $userName = "s2873575";
        $password = "dba";
        
        $this->connection = OCILogon($userName,$password,$description);
   
    }
    public function getConnection(){
        return $connection;
        
    }
    public function parseStatement($stmt){
        
        $stmt = OCIParse($this->connection,$stmt);
        //OCI_Define_By_Name($stmt,"ENAME",$name);        
        OCIExecute($stmt);
        
        return $stmt;
    }
    public function closeConnection(){
        
        OCILogoff($this->connection);
    }
    
}




