<?php
    session_start();
    include('connection.php');
    $con = connect();
    $today = getCurrentDate();
    if(isset($_POST) && isset($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
        $complain = $_POST['complain'];
        $query = "INSERT INTO complaints(`status`,`user_id`,`complaint`,`created_at`,`updated_at`)VALUES('PENDING','$userId','$complain','$today','$today')";
        $con->query($query) or die($con->error);

        $query = "SELECT * FROM complaints WHERE id = LAST_INSERT_ID()";
        $complaint = $con->query($query) or die($con->error);
        $complaintRow = $complaint->fetch_assoc();

        echo json_encode($complaintRow);
    }else{
        echo 'index.html';
    }
?>