<?php

final class Validation {
    public static $errors = [];
    public static function echoError ($name){
        if( isset(self::$errors[$name]) ){
            echo "<p>" . self::$errors[$name] . "</p>";
            unset(self::$errors[$name]);
        };
    }
    public static function filterData ($value) {
        return stripslashes(strip_tags(trim( $value )));
    }
    public static function checkString($name, $value){
        if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9]*$/',$value)){
            self::$errors[$name] = 
                "<p>{$name} has to start with a letter and contain only letters and numbers";
        };
    }
    public static function checkLength($name, $value, $length = 6){
        if ( strlen($value) < $length ){
            self::$errors[$name] = "Minimum length is " . $length;
        };
    }
    public static function checkRequired ($name, $value){
        if ( empty($value) ) self::$errors[$name] = "This field is required";
    }
    public static function checkNumber($name, $value){
        if (!preg_match('/^[0-9]+$/',$value)){
            self::$errors[$name] = "Please enter valid number";
        };
        return strval($value);
    }
    public static function checkEmail ($name, $value) {
        if( !filter_var($value, FILTER_VALIDATE_EMAIL) ){
            self::$errors[$name] = "Please enter valid email";
        }
    }
    public static function checkDate ($name, $value) {
        $test_arr  = explode('-', $value);
        if (!checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
            self::$errors[$name] = "Please enter valid Date";
        };
    }
    public static function checkPhone ($name, $value) {
        if( !preg_match("/^01[0-2,5][0-9]{8}$/",$value)){
            self::$errors[$name] = "please enter valid phone";
        };
    }

    // File validations
    public static function checkFileSize($file_name){
        $File = $_FILES[$file_name];
        if( $File['size'] == 0 ){
            self::$errors[$file_name] = "{$file_name} is required";
            return false;
        };
        return true;
    }
    public static function checkExtension($file_name){
        $fileArray = explode('/', $_FILES[$file_name]['type']);
        $fileExtension = strtolower(end( $fileArray ));
        $allowedExtensions = ['jpeg', 'jpg', 'png'];

        if( !in_array($fileExtension, $allowedExtensions) ){
            Validation::$errors[$file_name] = 'allowed extensions are only jpeg ,jpg and png';
            return false;
        };
        return $fileExtension;
    }
}

?>