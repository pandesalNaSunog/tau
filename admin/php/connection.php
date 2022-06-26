<?php
    function connect(){
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "tau_db";

        $con = new mysqli($hostname, $username, $password, $database);

        if($con->connect_error){
            echo $con->connect_error;
        }

        return $con;
    }

    function getCurrentDate(){
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        return $date;
    }
?>