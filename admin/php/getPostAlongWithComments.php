<?php

    session_start();
    include('connection.php');
    $con = connect();

    if(!isset($_SESSION['admin_id'])){
        echo 'index.html';
    }else{
        $postId = $_POST['post_id'];

        $query = "SELECT * FROM comments WHERE post_id = '$postId'";
        $post = $con->query($query) or die($con->error);
        $posts = array();
        while($row = $post->fetch_assoc()){
            $posts[] = $row;
        }

        echo json_encode($posts);
    }
?>