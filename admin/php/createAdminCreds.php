<?php
    include('connection.php');
    $con = connect();
    $date = getCurrentDate();


    $password = password_hash('adminpassword', PASSWORD_DEFAULT);
    $query = "INSERT INTO users(`user_type`,`name`,`email`,`password`,`profile_picture`,`created_at`,`updated_at`)VALUES('admin','Administrator','tauAdmin@gmail.com','$password','none','$date','$date')";
    $con->query($query) or die($con->error);
    echo 'ok';
?>