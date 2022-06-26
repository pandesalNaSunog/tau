<?php
    session_start();
    include('connection.php');
    $con = connect();

    if(isset($_GET) && isset($_SESSION['admin_id'])){
        $query = "SELECT * FROM users WHERE user_type != 'admin'";
        $user = $con->query($query) or die($con->error);
        $users = array();
        while($row = $user->fetch_assoc()){
            $users[] = $row;
        }
        echo json_encode($users);
    }else{
        echo 'unauthorized';
    }
?>