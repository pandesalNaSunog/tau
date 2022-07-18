<?php


    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        session_start();
        include('connection.php');
        $con = connect();
    
        if(!isset($_SESSION['user_id'])){
            echo 'index.html';
        }else if(isset($_SESSION['user_id']) && isset($_GET)){
            $query = "SELECT * FROM posts ORDER BY created_at DESC";
            $post = $con->query($query) or die($con->error);
            $posts = array();
            while($row = $post->fetch_assoc()){
                $posts[] = $row;
            }
            $response = array();
            foreach($posts as $postItem){
                $userId = $postItem['user_id'];
                $query = "SELECT * FROM users WHERE id = '$userId'";
                $user = $con->query($query) or die($con->error);
                $userRow = $user->fetch_assoc();
                $name = $userRow['name'];
                $date = date_create($postItem['created_at']);
                $date = date_format($date, 'M d, Y h:i A');
                $description = $postItem['description'];
                $profilePicture = $userRow['profile_picture'];
                $postId = $postItem['id'];
    
                $comments = array();
                //get latest comment
                $query = "SELECT * FROM comments WHERE post_id = '$postId' ORDER BY created_at DESC LIMIT 1";
                $comment = $con->query($query) or die($con->error);
                while($commentRow = $comment->fetch_assoc()){
                    $commentComment = $commentRow['comment'];
                    $commentUserId = $commentRow['user_id'];
                    $query = "SELECT * FROM users WHERE id = '$commentUserId'";
                    $commentUser = $con->query($query) or die($con->error);
                    $commentUserRow = $commentUser->fetch_assoc();
                    $commentUserName = $commentUserRow['name'];
                    $comments[] = array(
                        'name' => $commentUserName,
                        'comment' => $commentComment
                    );
                }
                $response[] = array(
                    'profile_picture' => $profilePicture,
                    'name' => $name,
                    'date' => $date,
                    'description' => $description,
                    'post_id' => $postId,
                    'comments' => $comments
                );
                
            }
            echo json_encode($response);
        }
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
    
?>