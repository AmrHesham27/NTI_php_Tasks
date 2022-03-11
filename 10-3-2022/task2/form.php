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

            // helpers
            function required_input ( $name ){
                global $errors;
                if( empty($_POST[$name]) ) $errors[$name] = "{$name} is required";
            };
            function minLength ( $name, $length ){
                global $errors;
                if ( strlen($_POST[$name]) < $length ){
                    $errors[$name] = "minimum length of " . $name . " is " . $length;
                };
            };
            function validate_string ( $name ){
                global $errors;
                if ( !ctype_alpha(str_replace(' ', '', $_POST[$name])) ){
                    $errors[$name] = $name . " can contain only letters ( A-Z, a-z ) and spaces";
                };
            };
            function filterData ( $name) {
                return stripslashes(strip_tags(trim( $_POST[$name] )));
            };

            // check inputs 
            required_input('Title');
            validate_string('Title');
            filterData('Title');
            required_input('Content');
            minLength('Content', 50);
            filterData('Content');

            // handle file (image)
            $Image = $_FILES['Image'];
            if( $Image['size'] == 0 ){
                $errors['Image'] = "the Image is required"; 
            }
            else {
                $fileArray = explode('/', $Image['type']);
                $fileExtension = end( $fileArray );
                $allowedExtensions = ['jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG'];
                if( !in_array($fileExtension, $allowedExtensions) ){
                    $errors['Image'] = 'allowed extensions are only jpeg ,jpg and png';
                };
                $FinalName = time() . rand() . '.' . $fileExtension;
                $disPath = 'uploads/' . $FinalName;
                if (!move_uploaded_file($Image['tmp_name'], $disPath)) {
                    echo 'try again ';
                };
            }

            // print errors
            if ( count($errors) != 0 ){
                foreach($errors as $error){
                    echo $error . "<br>";
                };
            };
            
            // write data to file
            echo $_POST['Title'] . "<br>";
            echo $_POST['Content'] . "<br>";
            echo $disPath;
        }
    ?>
    <form action=<?php echo $_SERVER['PHP_SELF'] ?> method='post' enctype="multipart/form-data" class="mx-auto my-5" style="width: 300px;">
        <div class="btn-3 mt-3">
            <label>Title</label>
            <input name="Title" class="form-control">
        </div>
        <div class="btn-3 mt-3">
            <label>Content</label>
            <input name="Content" class="form-control" minLength='50'>
        </div>
        <div class="btn-3 mt-3">
            <label>Image</label>
            <input type='file' name="Image" class="form-control">
        </div>
        
        <div class="btn-3 mt-5">
            <button type='submit' name="submit" class="btn btn-primary"> Post </button>
        </div>
    </form>
</body>
</html>