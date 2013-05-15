<?php

require_once 'resources/Faker/src/autoload.php';
include 'Connection.php';

//include 'User.php';


class DataStore{
    
    var $connection;
    
    public function __construct() {		//constructor
        $i = 4;
        $this->connection = new Connection("ibank_dba","billybob");
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
?>