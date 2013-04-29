<?php
//load web detail from database

$dbs = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dwarf.cit.griffith.edu.au)(PORT = 1526)))(CONNECT_DATA =(SID = DBS)(SERVER = DEDICATED)))";
$db = OCILogon("s2873575","dba",$dbs);
$stmt = OCIParse($db,"select * from emp2");
//OCI_Define_By_Name($stmt,"ENAME",$name);        
OCIExecute($stmt);
echo "test";
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
/*
echo"<TABLE border=1 width=90%>";
while(OCIFetch($stmt)){
	echo "<TR>";
 	echo "<TD width=33% onMouseover='this.style.backgroundColor=\"#33FF00\"'  onMouseout='this.style.backgroundColor=\"white\"'><A>$name</A></TD>";
    echo "</TR>";    
        
}
echo"</TABLE>";
*/
OCIFreeStatement($stmt);
OCILogoff($db);
 
?>


