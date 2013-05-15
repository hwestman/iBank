<?php
include 'connection.php';

$connection = new Connection("ibank_customer","billybob");
//$connection->parseFile("sql/structure.sql");



$query = "select * from ibank_dba.ibankSuburb";
$stmt = \oci_parse($connection->getConnection(), $query);

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

?>