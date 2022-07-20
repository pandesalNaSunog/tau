<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        session_start();

        include('connection.php');
        $con = connect();
        
        if(isset($_GET) && isset($_SESSION['admin_id'])){
            $query = "SELECT * FROM announcements ORDER BY id DESC";
            $announcement = $con->query($query) or die($con->error);
            $data = array();

            while($row = $announcement->fetch_assoc()){

                $date = date_create($row['created_at']);
                $date = date_format($data, 'M d, Y h:i A');

                $announcementId = $row['id'];
                $announcement = $row['description'];

                $data[] = array(
                    'id' => $announcementId,
                    'description' => $announcement,
                    'created_at' => $date
                );
            }
            echo json_encode($data);
        }else{
            echo 'index.html';
        }
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
?>