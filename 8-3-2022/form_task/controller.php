<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        function required_input($input_name){
            $result = ( empty($_POST[$input_name]) ) ? false : true ;
            if(!$result){
                echo "{$input_name} is required";
                exit();
            };
        };
        function min_length($input_name, $min_length){
            $result = ( strlen($_POST[$input_name]) < $min_length ) ? false : true;
            if(!$result){
                echo "{$input_name} has to be at least {$min_length} characters";
                exit();
            };
        };
        function string_type($input_name){
            $all_characters = range('A', 'Z');
            $first_character = strtoupper( $_POST[$input_name][0] );
            $result = in_array($first_character, $all_characters) ? true : false;
            if(!$result){
                echo "{$input_name} has to be string";
                exit();
            }
        }
        function validate_Email($input_name) {
            $result = ( filter_var($_POST[$input_name], FILTER_VALIDATE_EMAIL) ) ? true : false;
            if(!$result){
                echo "please enter a valid email";
                exit();
            };
        };
        function valid_URL($input_name){
            $result = ( filter_var($_POST[$input_name], FILTER_VALIDATE_URL) ) ? true : false;
            if(!$result){
                echo "please enter a valid URL";
                exit();
            };
        }
        // check inputs
        required_input('name');
        string_type('name');

        required_input('email');
        validate_Email('email');

        required_input('password');
        min_length('password', 6);

        required_input('address');
        min_length('address', 10);

        required_input('linkedInURL');
        valid_URL('linkedInURL');
    }
?>