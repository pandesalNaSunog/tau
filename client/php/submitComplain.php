<?php

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        session_start();
        include('connection.php');
        $con = connect();
        $today = getCurrentDate();
        if(isset($_POST) && isset($_SESSION['user_id'])){
            $userId = $_SESSION['user_id'];
            $complain = htmlspecialchars($_POST['complain']);
            $query = "INSERT INTO complaints(`status`,`user_id`,`complaint`,`created_at`,`updated_at`)VALUES('PENDING','$userId','$complain','$today','$today')";
            $con->query($query) or die($con->error);
    
            $query = "SELECT * FROM complaints WHERE id = LAST_INSERT_ID()";
            $complaint = $con->query($query) or die($con->error);
            $complaintRow = $complaint->fetch_assoc();
    
            echo json_encode($complaintRow);
        }else{
            echo 'index.html';
        }
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
    
?>