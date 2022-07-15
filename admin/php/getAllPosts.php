<?php
    session_start();
    include('connection.php');
    $con = connect();

    if(!isset($_SESSION['admin_id'])){
        echo 'index.html';
    }else{
        $userId = $_SESSION['admin_id'];
        $query = "SELECT * FROM posts ORDER BY id DESC";
        $post = $con->query($query) or die($con->error);
        $posts = array();

        while($row = $post->fetch_assoc()){
            $posts[] = $row;
        }

        $postsWithName = array();

        foreach($posts as $postItem){
            $query = "SELECT * FROM users WHERE id = '$userId'";
            $user = $con->query($query) or die($con->error);
            $row = $user->fetch_assoc();
            $name = $row['name'];
            $profilePicture = $row['profile_picture'];
            $date = date_create($postItem['created_at']);
            $id = $postItem['id'];
            $postsWithName[] = array(
                'name' => $name,
                'description' => $postItem['description'],
                'date' => date_format($date, 'M d, Y h:i A'),
                'post_id' => $id,
                'profile_picture' => $profilePicture
            );
        }

        echo json_encode($postsWithName);
    }
?>