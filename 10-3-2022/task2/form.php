<?php 
    include_once './components/header.php';
    include_once './components/navBar.php';

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
        $Title = filterData('Title');
        required_input('Content');
        minLength('Content', 50);
        $Content = filterData('Content');

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
        $db = fopen('db.txt', 'a') or die('could not open file');
        $new_data = "Title={$Title} Content={$Content} disPath={$disPath}\n";
        fwrite($db, $new_data);
        fclose($db);
    }
?>
<form action=<?php echo $_SERVER['PHP_SELF'] ?> method='post' enctype="multipart/form-data" 
      class="mx-auto my-5" style="width: 300px;">
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
<?php
    include_once './components/footer.php';
?>