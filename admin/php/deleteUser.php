<?php
    session_start();
    include('connection.php');
    $con = connect();

    if(isset($_POST) && isset($_SESSION['admin_id'])){
        $userId = $_POST['user_id'];
        $query = "DELETE FROM users WHERE id = '$userId'";
        $con->query($query) or die($con->error);

        $query = "DELETE FROM comments WHERE user_id = '$userId'";
        $con->query($query) or die($con->error);


        echo 'ok';
    }else{
        echo 'index.html';
    }
?>