<?php
include 'connection.php';

$connection = new Connection();


$res = $connection->parseStatement("select * from emp2;");

echo "<table border='1'>\n";
while ($row = oci_fetch_array($res, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

?>