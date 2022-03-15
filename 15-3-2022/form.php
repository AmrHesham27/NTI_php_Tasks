<?php 
include_once './checkLogin.php';
require_once './components/header.php';
require_once './components/navBar.php';
require_once './validation.php';
require_once './dbConnection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // validate data
    $Title = $_POST['Title'];
    Validation::required_input('Title', $Title);
    Validation::validate_string('Title', $Title);
    $Title = Validation::filterData($Title);

    $Content = $_POST['Content'];
    Validation::required_input('Content', $Content);
    Validation::minLength('Content', $Content, 50);
    $Content = Validation::filterData($Content);

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
            echo 'please try again ';
        };
    }
    // print errors if any
    if ( count(Validation::$errors) != 0 ){
        foreach(Validation::$errors as $error){
            echo $error . "<br>";
        };
    }
    else {
        // save in sql 
        $sql = "insert into articles (Title, Content, disImg) values ('$Title','$Content','$disPath')";
        $op =  mysqli_query($con,$sql);
        if ($op){
            echo 'Your article was inserted';
        }else {
            echo 'Error Try Again '.mysqli_error($con);
        }
        mysqli_close($con);
    }
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