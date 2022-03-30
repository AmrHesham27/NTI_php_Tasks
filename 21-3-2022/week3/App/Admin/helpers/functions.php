<?php 

function Clean($input){
 
    return  stripslashes(strip_tags(trim($input)));
}





function Validate($input,$flag,$length = 6){

     $status = true; 

     switch ($flag) {

         case "Date":
            $test_arr = explode('-', $input);
            if (!checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
                $status = false; 
            };
        
         case "required":
             # code...
             if(empty($input)){

                $status = false; 
             }
             break;


         case "email":
                # code...
                if(!filter_var($input, FILTER_VALIDATE_EMAIL)){
   
                   $status = false; 
                }
                break; 

        case "number":       
             # code...
             if(!filter_var($input, FILTER_VALIDATE_INT)){
   
                $status = false; 
             }
             break;   
                

        case "length": 
            # Code ... 
             if(strlen($input) < $length){
                 $status = false;
             }      
             break; 



         case "image": 
            # code 

        $imgType    = $input['image']['type'];
        # Allowed Extensions 
        $allowedExtensions = ['jpg', 'png','jpeg'];

        $imgArray = explode('/', $imgType);

        # Image Extension ...... 
         $imageExtension =  strtolower(end($imgArray));


        if (!in_array($imageExtension, $allowedExtensions)) {
            $status = false; 
        }
            
            break; 





     }

    return $status; 
}






function PrintMessages($message = null){

    if(isset($_SESSION['Message'])){
            
        foreach ($_SESSION['Message'] as $key => $value) {
            # code...

            echo '*'.$key.' : '.$value.'<br>';
        }

         unset($_SESSION['Message']);

    }  else{
        echo '   <li class="breadcrumb-item active">'.$message.'</li>';
    }  
}


 function doQuery($sql){
     $result = mysqli_query($GLOBALS['con'],$sql);
     return $result;  
 }


 function DBRemove($table,$id){

     $sql = "delete from $table where id = $id"; 
     $op  = mysqli_query($GLOBALS['con'],$sql); 

     if($op){
         $status = true;
     }else{
         $status = false; 
     }


    mysqli_close($GLOBALS['con']);

     return $status;
 }



  function Upload($input){


            # Upload Image ..... 

            $image = null;

            $imgType    = $input['Image']['type'];
      
            $imgArray = explode('/', $imgType);
    
            # Image Extension ...... 
             $imageExtension =  strtolower(end($imgArray));



            $FinalName = time() . rand() . '.' . $imageExtension;

            $disPath = 'uploads/' . $FinalName;
    
            $imgTemName = $_FILES['Image']['tmp_name'];
    
    
            if (move_uploaded_file($imgTemName, $disPath)) {
            
                $image = $FinalName; 
            }

            return $image; 
  }
