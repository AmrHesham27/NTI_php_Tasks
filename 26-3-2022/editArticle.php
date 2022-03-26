<?php 
    include_once './components/header.php';
    include_once './components/navBar.php';

    Auth::isLoggedIn();
    $writer = new Writer();
    $id = $_GET['id'];
    $article = $writer->getOneArticle($id);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $writer->editArticle(   
            $article['imagePath'],  
            $article['id'], 
            $_POST['Title'], 
            $_POST['Content'], 
            'Image'
        );
    };
    $article = $writer->getOneArticle($id);
?>

<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id ?> method='post' enctype="multipart/form-data" 
      class="mx-auto my-5" style="width: 300px;">
    <div class="btn-3 mt-3">
        <label>Title</label>
        <input value=<?php echo $article['articleName'] ?> name="Title" class="form-control">
        <?php
            Validation::echoError('Title');
        ?>
    </div>
    <div class="btn-3 mt-3">
        <label>Content</label>
        <textarea name="Content" class="form-control" minLength='50'>
            <?php echo $article['content'] ?>
        </textarea>
        <?php
            Validation::echoError('Content');
        ?>
    </div>
    <div class="btn-3 mt-3">
        <label>Image</label>
        <img width="100" height="100" src=<?php echo $article['imagePath'] ?>>
        <input type='file' name="Image" class="form-control">
        <?php
            Validation::echoError('Image');
        ?>
    </div>
    
    <div class="btn-3 mt-5">
        <button type='submit' name="submit" class="btn btn-primary"> Post </button>
    </div>
    <?php
        include_once './components/mssg.php';
    ?>
</form>
<?php
    include_once './components/footer.php';
?>