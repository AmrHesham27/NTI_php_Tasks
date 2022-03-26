<?php
class Writer extends User {
    use Upload;
    public $main_table = 'writers';
    public $foreign_table = 'articles';
    
    public function addArticle($title, $content, $fileName){
        $SQL = new SQL();
        $userId = $_SESSION[Session::$userId];

        $title = Validation::filterData($title);
        Validation::checkRequired('title', $title);
        Validation::checkString('title', $title);

        $content = Validation::filterData($content);
        Validation::checkRequired('content', $content);
        Validation::checkLength('content', $content, 50);

        $disImg = $this->uploadImage($fileName);

        if(count(Validation::$errors) != 0) return;
        $sql = "INSERT INTO {$this->foreign_table} (articleName, content, imagePath, writer_id) VALUES 
        ('$title', '$content', '$disImg', '$userId');";
        $SQL->doQuery($sql);
        $_SESSION[Session::$mssg] = 'Your article was added successfully';
    }

    public function editArticle($old_file_path, $article_id, $title, $content, $fileName){
        $SQL = new SQL();
        $userId = $_SESSION[Session::$userId];

        $title = Validation::filterData($title);
        Validation::checkRequired('title', $title);
        Validation::checkString('title', $title);

        $content = Validation::filterData($content);
        Validation::checkRequired('content', $content);
        Validation::checkLength('content', $content, 50);

        $disImg = $old_file_path;
        if( $_FILES[$fileName]['size'] != 0 ){
            $disImg = $this->uploadImage($fileName);
            if($disImg && file_exists($old_file_path)) unlink($old_file_path);
        }

        if(count(Validation::$errors) != 0) return;
        $sql = "UPDATE {$this->foreign_table} SET 
        articleName = '$title', content = '$content', imagePath = '$disImg'
        WHERE id = $article_id AND writer_id = $userId;";
        $SQL->doQuery($sql);
        $_SESSION[Session::$mssg] = 'your article was edited successfully';
    }

    public function deleteArticle($article_id){
        $SQL = new SQL();
        $userId = $_SESSION[Session::$userId];

        $sql = "DELETE FROM {$this->foreign_table} 
        WHERE id = $article_id AND writer_id = $userId;";
        $SQL->doQuery($sql);
        $_SESSION[Session::$mssg] = 'your article was deleted';
    }

    public function getOneArticle($article_id){
        $SQL = new SQL();
        $userId = $_SESSION[Session::$userId];

        $sql = "SELECT * FROM {$this->foreign_table} 
        WHERE writer_id = $userId AND id = $article_id;";
        $result = $SQL->doQuery($sql);
        if(mysqli_num_rows($result) == 0) header("Location: index.php");

        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function getMyArticles(){
        $SQL = new SQL();
        $userId = $_SESSION[Session::$userId];

        $sql = "SELECT * FROM {$this->foreign_table} WHERE writer_id = $userId;";
        $result = $SQL->doQuery($sql);
        if(mysqli_num_rows($result) == 0) $_SESSION[Session::$mssg] = 'you do not have any articles yet';
        return $result;
    }
}

?>