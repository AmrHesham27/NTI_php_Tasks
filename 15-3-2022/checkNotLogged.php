<?php
session_start();
if(count($_SESSION) != 0){
    header("Location: blog.php");
}
?>