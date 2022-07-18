<?php
    session_start();
    include('connection.php');
    $con = connect();
    $date = getCurrentDate();
    if(isset($_POST) && isset($_SESSION['admin_id'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query = "INSERT INTO announcements(`title`,`description`,`created_at`,`updated_at`)VALUES('$title','$description','$date','$date')";
        $con->query($query) or die($con->error);
        $query = "SELECT * FROM announcements WHERE id = LAST_INSERT_ID()";
        $announcement = $con->query($query) or die($con->error);
        $row = $announcement->fetch_assoc();

        echo json_encode($row);
    }else{
        echo 'index.html';
    }
?>