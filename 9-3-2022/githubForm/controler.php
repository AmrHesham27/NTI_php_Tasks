<?php
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        $errors = array();
        $url = $_POST['github_URL'];
        if( !filter_var($url, FILTER_VALIDATE_URL) ){
            $errors['url'] = 'this is not valid URL';
        }
        if( !strpos($url, 'github') ){
            $errors['github'] = 'this is not github link';
        };

        if( count($errors) != 0 ){
            foreach( $errors as $error_key => $error_value ){
                echo $error_value . "<br>";
            }
        };
    } 
?>