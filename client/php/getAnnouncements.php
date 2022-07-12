<?php
    include('connection.php');
    $con = connect();

    if(isset($_GET)){
        $query = "SELECT * FROM announcements";
        $announcement = $con->query($query) or die($con->error);
        $announcements = array();

        while($row = $announcement->fetch_assoc()){
            $description = $row['description'];
            $createdAt = date_format(date_create($row['created_at']), "M d, Y h:i A");
            $announcements[] = array(
                'announcement' => $description,
                'date' => $createdAt
            );
        }

        echo json_encode($announcements);
    }
?>