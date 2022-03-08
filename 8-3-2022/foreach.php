<?php
    $students = array(      
        ["id" => 2013,"name" => "Root Account","email" => "root@root.com"],
        ["id" => 2014,"name" => "x Account","email" => "x@root.com"],
        ["id" => 2015,"name" => "Y Account","email" => "Y@root.com"]
    );
    foreach($students as $student){
        foreach($student as $key => $value){
            echo $key . " equla to " . $value;
            echo "<br/>";
        };
    };

?>