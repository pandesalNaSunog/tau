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

        $query = "SELECT * FROM comments WHERE id = LAST_INSERT_ID()";
        $comment = $con->query($query) or die($con->error);
        $commentRow = $comment->fetch_assoc();
        $commentUserId = $commentRow['user_id'];

        $query = "SELECT * FROM users WHERE id = '$userId'";
        $user = $con->query($query) or die($con->error);
        $userRow = $user->fetch_assoc();
        $commentName = $userRow['name'];
        $comment = $commentRow['comment'];
        $response = array(
            'name' => $commentName,
            'comment' => $comment
        );
        echo json_encode($response);
    }else{
        echo 'index.html';
    }
?>