<?php
class User {
    public $main_table;

    public function login($email, $password){
        $SQL = new SQL();

        $email = Validation::filterData($email);
        Validation::checkRequired('email', $email);

        $password = Validation::filterData($password);
        Validation::checkRequired('password', $password);
        Validation::checkLength('password', $email, 6);

        if(count(Validation::$errors) != 0) return;
        $password = md5($password);

        $sql = "SELECT * FROM {$this->main_table} 
        WHERE userEmail = '$email' AND userPassword = '$password'";
        $result = $SQL->doQuery($sql);

        if ( mysqli_num_rows($result) == 0 ){
            $_SESSION[Session::$mssg] = 'email or password is wrong';
            return;
        };

        $row = mysqli_fetch_assoc($result);
        $_SESSION[Session::$userId] = $row['id'];
        header("Location: index.php");
    }

    public function register($name, $email, $password, $confirm){
        $SQL = new SQL();

        $name = Validation::filterData($name);
        Validation::checkRequired('name', $name);
        Validation::checkString('name', $name);

        $email = Validation::filterData($email);
        Validation::checkRequired('email', $email);
        Validation::checkEmail('email', $email);

        $password = Validation::filterData($password);
        Validation::checkRequired('password', $password);
        Validation::checkLength('password', $email, 6);

        if($confirm != $password) 
            Validation::$errors[$name] = 'password and confirm password do not match';

        if(count(Validation::$errors) != 0) return;
        $password = md5($password);

        $sql = "INSERT INTO {$this->main_table} (userName, userEmail, userPassword) VALUES 
        ('$name', '$email', '$password');";
        $SQL->doQuery($sql);
        $_SESSION[Session::$mssg] = 'You were registered successfully';
    }
    public function logout(){
        session_destroy();
        header("Location: index.php");
    }
}

?>