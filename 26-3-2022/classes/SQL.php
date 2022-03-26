<?php

final class SQL {
    private $server = "localhost";
    private $dbName = "blog-26-3-2022";
    private $dbUser = "root";
    private $dbPassword= "";
    private $con;

    public function __construct(){
        $con = mysqli_connect($this->server,$this->dbUser,$this->dbPassword,$this->dbName);
        if(!$con) die( 'Error '.mysqli_connect_error() ); 
        $this->con = $con;
    }

    public function doQuery($sql){
        $result = mysqli_query($this->con, $sql);
        if (!$result){
            $_SESSION[Session::$mssg] = 'Error Try Again '.mysqli_error($this->con);
            exit();
        };
        return $result;
    }

    public function __destruct(){
        mysqli_close($this->con);
    }
}

?>