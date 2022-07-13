<?php
    session_start();
    include('connection.php');
    $con = connect();


    if(isset($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id = '$userId'";
        $user = $con->query($query) or die($con->error);
        $userRow = $user->fetch_assoc();
        echo json_encode($userRow);
    }else{
        echo 'index.html';
    }
?>