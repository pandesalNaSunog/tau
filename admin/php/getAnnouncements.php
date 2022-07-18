<?php
    session_start();

    include('connection.php');
    $con = connect();
    
    if(isset($_GET) && isset($_SESSION['admin_id'])){
        $query = "SELECT * FROM announcements";
        $announcement = $con->query($query) or die($con->error);
        $data = array();

        while($row = $announcement->fetch_assoc()){
            $data[] = $row;
        }
        echo json_encode($data);
    }else{
        echo 'index.html';
    }
?>