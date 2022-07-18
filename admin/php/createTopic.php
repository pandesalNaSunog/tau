<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        session_start();
        include('connection.php');
        $con = connect();
        $date = getCurrentDate();

        if(!isset($_SESSION['admin_id'])){
            echo 'index.html';
        }else{
            $title = $_POST['title'];
            $description = $_POST['description'];
            $userId = $_SESSION['admin_id'];

            $query = "INSERT INTO posts(`user_id`,`title`,`description`,`created_at`,`updated_at`)VALUES('$userId','$title','$description','$date','$date')";
            $con->query($query) or die($con->error);

            $query = "SELECT * FROM users WHERE id = '$userId'";
            $user = $con->query($query) or die($con->error);

            $query = "SELECT * FROM posts WHERE id = LAST_INSERT_ID()";
            $post = $con->query($query) or die($con->error);
            $postRow = $post->fetch_assoc();

            $data = $user->fetch_assoc();
            $name = $data['name'];

            $date = date_create($date);
            $formattedDate = date_format($date, 'M d, Y h:i A');

            echo json_encode(array(
                'title' => $title,
                'description' => $description,
                'name' => $name,
                'date' => $formattedDate,
                'post_id' => $postRow['id']
            ));
        }
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
?>