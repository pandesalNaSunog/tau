<?php
    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        include('connection.php');
        $con = connect();

        if(isset($_GET)){
            $query = "SELECT * FROM announcements ORDER BY id DESC";
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
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
?>