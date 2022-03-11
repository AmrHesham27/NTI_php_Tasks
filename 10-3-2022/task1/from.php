<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            session_start();
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
            };
            $Title = stripslashes(strip_tags(trim( $_POST['Title'] )));
            $Content = stripslashes(strip_tags(trim( $_POST['Content'] )));

            required_input('Title');
            minLength('Title', 10);

            required_input('Content');
            minLength('Content', 30);

            if( count($errors) == 0 ){
                echo "success!!!";
                $_SESSION['Title'] = $Title;
                $_SESSION['Content'] = $Content;
            }
            else {
                foreach($errors as $error){
                    echo $error . "<br/>";
                };
            };
        }
    ?>
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method='post' enctype="multipart/form-data" class="mx-auto my-5" style="width: 300px;">
        <div class="btn-3 mt-3">
            <label>Title</label>
            <input name="Title" class="form-control">
        </div>
        <div class="btn-3 mt-3">
            <label>Content</label>
            <input name="Content" class="form-control">
        </div>
        
        <div class="btn-3 mt-5">
            <button type='submit' name="submit" class="btn btn-primary"> Add </button>
        </div>
    </form>
</body>
</html>