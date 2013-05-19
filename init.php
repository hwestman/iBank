<?php
include 'db_layer/DataStore.php';

    switch ($_GET['action']) {
        case 'shuffle':
            shuffles();
            break;
        case 'generate':
            $datastore->generateAustraliaPost();
        break;
    }

function shuffles(){
    $file = file_get_contents('resources/suburbs.txt', true);

    $data = explode("\n", $file);
    array_shift($data);
    shuffle($data);
    
    
    foreach($data as $suburb){
        file_put_contents('./resources/suburbs_shuffled.txt', $suburb,FILE_APPEND); 
    }
    
}

        
        
?>
