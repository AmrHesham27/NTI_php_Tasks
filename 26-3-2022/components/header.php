<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='styles.css' rel="stylesheet">
    <title>Blog</title>
</head>
<body>

<?php
session_start();
// method to require all classes automatically
function my_autoloader($class) {
    if (!class_exists($class)){
        require_once 'classes/' . $class . '.php';
    };
}
spl_autoload_register('my_autoloader');
?>

