<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';

#
# Fetch  User Roles 
$sql = "select * from categories"; 
$categories  = doQuery($sql);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    // CODE ..... 
    $Title     = Clean($_POST['Title']);
    $Content    = Clean($_POST['Content']);
    $Category = Clean($_POST['Category']);
    $Date    = Clean($_POST['Date']);
    $Writer  = 1;
    $Image = $_FILES['Image'];

   
    # VALIDATE INPUT ...... 
    $errors = []; 
    
    if(!Validate($Title,'required')){     
        $errors['Title'] = "Field Required";
    }
    if(!Validate($Title, 'length')){
        $errors['Title'] = "minimum lemgth is 6";
    }

    if(!Validate($Content,'required')){     
        $errors['Content'] = "Field Required";
    }
    if(!Validate($Content, 'length', 50)){
        $errors['Content'] = "minimum lemgth is 50";
    }

    if(!Validate($Category,'required')){     
        $errors['Category'] = "Field Required";
    }
    if(!Validate($Category, 'number')){
        $errors['Category'] = "invalid category";
    }

    if(!Validate($Date,'required')){     
        $errors['Date'] = "Field Required";
    }
    if(!Validate($Date, 'Date')){
        $errors['Date'] = "invalid date";
    }

    if(!Validate($Writer,'required')){     
        $errors['Writer'] = "Field Required";
    }
    if(!Validate($Writer, 'number')){
        $errors['Writer'] = "invalid writer";
    }

    if(!Validate($Image,'required')){     
        $errors['Image'] = "Field Required";
    }
    if(!Validate($Image, 'Image')){
        $errors['Image'] = "not allowed extension";
    }



    # Checke errors 
    if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
    }else{
        // code ..... 
        $Image = Upload($_FILES);

       $sql = "insert into articales (title, content, cat_id, image, date, addedBy) 
       values ('$Title', '$Content', '$Category', '$Image', '$Date', '$Writer')"; 
       $op  = doQuery($sql);


       if($op){
           $message = ["Message" => "article Inserted"];
       }else{
           $message = ["Message" => "Error Try Again"]; 
       }

       $_SESSION['Message'] = $message; 


    }


}

##########################################################################################################





require '../layouts/header.php';

require '../layouts/nav.php';

require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
      
      
          <?php 
            PrintMessages('Dashboard / Articles / Create'); 
          ?>
      
        
        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="Title" placeholder="Enter Article Title">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Content</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="Content" placeholder="Enter Article Content">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Category</label>
                <select class="form-control" id="exampleInputPassword1" name="Category">

                    <?php

                    while ($data = mysqli_fetch_assoc($categories)) {

                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['title']; ?></option>

                    <?php } ?>

                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="Image">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Date</label>
                <input type="date" class="form-control"  id="exampleInputName" aria-describedby="" name="Date" placeholder="Enter Date">
            </div>
            
        

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>