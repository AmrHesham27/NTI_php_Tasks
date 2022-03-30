<?php
    $all_data = file_get_contents('http://shopping.marwaradwan.org/api/Products/1/1/0/10/atoz');
    $all_data_json = json_decode($all_data)->data;
    foreach($all_data_json as $key => $value){
        echo 'product id '.$value->products_id.'<br/>'.$value->products_name.'<br/>'.$value->products_description;
    }
?>