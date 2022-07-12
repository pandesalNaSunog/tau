<?php
    session_start();
    include('connection.php');
    $con = connect();
    $today = getCurrentDate();
    if(isset($_SESSION['user_id']) && isset($_POST)){
        $userId = $_SESSION['user_id'];
        $comment = $_POST['comment'];
        $postId = $_POST['post_id'];

        $query = "INSERT INTO comments(`user_id`,`post_id`,`comment`,`created_at`,`updated_at`)VALUES('$userId','$postId','$comment','$today','$today')";
        $con->query($query) or die($con->error);
    }else{
        echo 'index.html';
    }
?>