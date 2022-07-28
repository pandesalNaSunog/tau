<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        session_start();
        include('connection.php');
        $con = connect();
        $today = getCurrentDate();
        if(isset($_POST) && isset($_SESSION['user_id'])){
            $userId = $_SESSION['user_id'];
            $announcement = htmlspecialchars($_POST['announcement']);
            $title = "Title";
            $query = $con->prepare('INSERT INTO announcements(user_id,title,description,created_at,updated_at)VALUES(?,?,?,?,?)');
            $query->bind_param("issss", $userId, $title, $announcement, $today, $today);
            $query->execute();

            $newquery = "SELECT * FROM announcements WHERE id = LAST_INSERT_ID()";
            $getAnnouncement = $con->query($newquery) or die($con->error);
            $announcementRow = $getAnnouncement->fetch_assoc();

            echo json_encode($announcementRow);
        }else{
            echo 0;
        }
    }else{
        echo header('HTTP/1.1 4-3 Forbidden');
    }
?>