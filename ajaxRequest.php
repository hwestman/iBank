<?php

include_once "db_layer/DataStore.php";

$ret = null;
$json = $_POST['json'];

switch ($_POST['action']) {
    case 'getSuburbs':
        $postCode=$_POST['postcode'];
        $ret = $datastore->getSuburbs($postCode);
        
    break;
                
}

if($json){
    $ret = json_encode($ret);
    echo $ret;
}else{
    echo $ret;
}
      
function getAjaxSuburbs(){
    return $datastore->getSuburbs();
}
?>
