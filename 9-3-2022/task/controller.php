<?php
    $errors = [];
    function required_input ( $name ){
        global $errors;
        if( empty($_POST[$name]) ) $errors[$name] = "{$name} is required";
    }
    function minLength ( $name, $length ){
        global $errors;
        if ( strlen($_POST[$name]) < $length ){
            $errors[$name] = "minimum length of " . $name . " is " . $length;
        };
    }

    // check inputs
    required_input('name');
    $name = $_POST['name'];
    $all_characters = range('A', 'Z');
    $first_character = strtoupper( $name[0] );
    $result = in_array($first_character, $all_characters) ? true : false;
    if(!$result) $errors['name'] = "name has to be string";
    $name = stripslashes(strip_tags(trim($name))); 

    $email = $_POST['email'];
    required_input('email');
    if ( !filter_var(trim($email), FILTER_VALIDATE_EMAIL) ){
        $errors['email'] = 'email is not valid';
    };

    required_input('password');
    minLength('password', 6);
    $password = $_POST['password'];
    $password = stripslashes(strip_tags(trim($password)));

    required_input('address');
    minLength('address', 10);
    $address = $_POST['address'];
    $address = stripslashes(strip_tags(trim($address)));

    $gender = $_POST['gender'];
    required_input('gender');
    if( !in_array($gender, ['male', 'female']) ){
        $errors['gender'] = "allowed genders are male and female only";
    };

    $url = $_POST['url'];
    required_input('url');
    if ( !filter_var(trim($url), FILTER_VALIDATE_URL) ){
        $errors['url'] = 'url is not valid';
    };

    $cv = $_FILES['cv'];
    if( $cv['size'] == 0 ){
        $errors['cv'] = "the cv is required"; 
    };
    $fileArray = explode('/', $cv['type']);
    $fileExtension = end( $fileArray );
    if( $fileExtension != 'pdf' ){
        $errors['cv'] = 'only pdf is allowed';
    }

    // print message 
    if( count($errors) == 0 ){
        echo "success!!!";
        exit();
    } 
    foreach($errors as $error){
        echo $error . "<br/>";
    };
?>