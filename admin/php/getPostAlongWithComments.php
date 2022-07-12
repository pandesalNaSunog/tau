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
        $response = array();
        foreach($posts as $commentItem){
            $userId = $commentItem['user_id'];
            $query = "SELECT * FROM users WHERE id = '$userId'";
            $user = $con->query($query) or die($con->error);
            $row = $user->fetch_assoc();
            $name = $row['name'];
            $response[] = array(
                'name' => $name,
                'comment' => $commentItem['comment']
            );
        }

        echo json_encode($response);
    }
?>