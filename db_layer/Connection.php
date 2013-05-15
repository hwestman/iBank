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
    public function closeConnection(){
        OCILogoff($this->connection);
    }
    
}




