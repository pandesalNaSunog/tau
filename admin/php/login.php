<?php
    session_start();
    include('connection.php');
    $con = connect();

    if(isset($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        //check if email exists
        $query = "SELECT * FROM users WHERE email = '$email' AND user_type = 'admin'";
        $user = $con->query($query) or die($con->error);
        $users = array();
        while($row = $user->fetch_assoc()){
            $users[] = $row;
        }
        if(count($users) == 1){
            if(password_verify($password, $users[0]['password'])){
                $_SESSION['admin_id'] = $users[0]['id'];
                echo 'panel.html';
            }else{
                echo 'invalid';
            }
        }else{
            echo 'invalid';
        }
    }
?>