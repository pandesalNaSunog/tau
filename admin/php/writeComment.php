<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        session_start();
        include('connection.php');
        $con = connect();
        $date = getCurrentDate();

        if(isset($_POST) && $_SESSION['admin_id']){
            $adminId = $_SESSION['admin_id'];
            $postId = $_POST['post_id'];
            $comment = $_POST['comment'];
            $query = "INSERT INTO comments(`user_id`,`post_id`,`comment`,`created_at`,`updated_at`)VALUES('$adminId','$postId','$comment','$date','$date')";
            $con->query($query) or die($con->error);
            $query = "SELECT * FROM comments WHERE id = LAST_INSERT_ID()";
            $comment = $con->query($query) or die($con->error);
            $row = $comment->fetch_assoc();

            echo json_encode($row);
        }else{
            echo 'index.html';
        }
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
?>