<?php
    include('connection.php');
    $con = connect();
    
    if(isset($_GET)){
        $query = "SELECT * FROM announcements";
        $announcement = $con->query($query) or die($con->error);
        $data = array();

        while($row = $announcement->fetch_assoc()){
            $data[] = $row;
        }
        echo json_encode($data);
    }
?>