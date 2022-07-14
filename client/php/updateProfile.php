<?php
    session_start();

    include('connection.php');
    $con = connect();

    if(isset($_POST) && isset($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET email = '$email', password = '$password', name = '$name' WHERE id = '$userId'";
        $con->query($query) or die($con->error);

        echo 'ok';
    }else{
        echo 'index.html';
    }
?>