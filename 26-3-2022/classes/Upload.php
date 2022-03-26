<?php
trait Upload{
    public function uploadImage($file_name){
        
        if ( !Validation::checkFileSize($file_name) ) return;
        $fileExtension = Validation::checkExtension($file_name);
        if ( !Validation::checkExtension($file_name) ) return;
        
        $FinalName = time() . rand() . '.' . $fileExtension;
        $disImg = 'uploads/' . $FinalName;
        if ( !move_uploaded_file($_FILES[$file_name]['tmp_name'], $disImg) ) {
            Validation::$errors['File'] = 'could not upload the file please try again';
            return;
        };
        return $disImg;
    }
}
?>