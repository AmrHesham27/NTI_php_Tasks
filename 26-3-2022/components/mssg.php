<?php
if( isset($_SESSION[Session::$mssg]) ){
    echo "<p>" . $_SESSION[Session::$mssg] . "</p>";
    unset($_SESSION[Session::$mssg]);
};
?>