<?php
    session_start();
    include('connection.php');
    $con = connect();
    $date = getCurrentDate();


    if(isset($_POST) && isset($_SESSION['admin_id'])){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $userType = $_POST['user_type'];
        //check if email already exists
        $query = "SELECT * FROM users WHERE email = '$email'";
        $user = $con->query($query) or die($con->error);
        $users = array();
        while($row = $user->fetch_assoc()){
            $users[] = $row;
        }

        if(count($users) == 1){
            echo 'email exists';
        }else{
            $password = password_hash('password', PASSWORD_DEFAULT);
            $query = "INSERT INTO users(`name`,`email`,`user_type`,`password`,`created_at`,`updated_at`)VALUES('$name','$email','$userType','$password','$date','$date')";
            $con->query($query) or die($con->error);
            $query = "SELECT * FROM users WHERE id = LAST_INSERT_ID()";
            $user = $con->query($query) or die($con->error);
            $data = $user->fetch_assoc();

            echo json_encode($data);
        }
    }else{
        echo 'Unauthorized';
    }
?>