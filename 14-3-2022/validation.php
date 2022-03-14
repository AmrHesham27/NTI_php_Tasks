<?php
class Validation {
    public static $errors = [];
    public static function required_input ( $name, $value ){
        if ( empty($value) ) self::$errors[$name] = "{$name} is required";
    }
    public static function minLength ( $name, $value, $length ){
        if ( strlen($value) < $length ){
            self::$errors[$name] = "minimum length of " . $name . " is " . $length;
        };
    }
    public static function validate_string ( $name, $value ){
        if ( !ctype_alpha(str_replace(' ', '', $value)) ){
            self::$errors[$name] = $name . " can contain only letters ( A-Z, a-z ) and spaces";
        };
    }
    public static function filterData ($value) {
        return stripslashes(strip_tags(trim( $value )));
    }
}
?>