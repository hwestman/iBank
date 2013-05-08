<?php
include 'connection.php';

$connection = new Connection();
$connection->parseFile("sql/structure.sql");
/*
$res = $connection->parseStatement("select * from emp2");
 
echo "<table border='1'>\n";
while ($row = oci_fetch_array($res, OCI_BOTH)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
        
oci_free_statement($stmt);
 * 
 * 
 */
$this->closeConnection();

?>