<?php
    include('connection.php');
    $con = connect();
    $date = getCurrentDate();
    if(isset($_POST)){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query = "INSERT INTO announcements(`title`,`description`,`created_at`,`updated_at`)VALUES('$title','$description','$date','$date')";
        $con->query($query) or die($con->error);
        $query = "SELECT * FROM announcements WHERE id = LAST_INSERT_ID()";
        $announcement = $con->query($query) or die($con->error);
        $row = $announcement->fetch_assoc();

        echo json_encode($row);
    }
?>