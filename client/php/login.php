<?php
    session_start();
    include('connection.php');
    $con = connect();
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = '$email' AND user_type != 'admin'";
        $user = $con->query($query) or die($con->error);
        if($row = $user->fetch_assoc()){
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                echo 'panel.html';
            }else{
                echo 'invalid';
            }
        }else{
            echo 'invalid';
        }
    }else{
        echo 'unauthorized';
    }
?>