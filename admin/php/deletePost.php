<?php
    session_start();
    include('connection.php');
    $con = connect();

    if(!isset($_SESSION['admin_id'])){
        echo 'index.html';
    }else if(isset($_POST)){
        $postId = $_POST['post_id'];
        $query = "DELETE FROM posts WHERE id = '$postId'";
        $con->query($query) or die($con->error);
        echo 'ok';
    }
?>