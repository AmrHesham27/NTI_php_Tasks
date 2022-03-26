<?php
class Auth {
    private static function goToIndex(){
        header("Location: index.php");
    }
    public static function noLoggedInUser (){
        if(isset ($_SESSION[Session::$userId]) ) self::goToIndex();
    }
    public static function isLoggedIn(){
        if( !isset($_SESSION[Session::$userId]) ) self::goToIndex();
    }
}
?>