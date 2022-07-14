<?php
    session_start();
    include('connection.php');
    $con = connect();
    $today = getCurrentDate();

    if(isset($_POST) && isset($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
        $receiverId = $_POST['receiver_id'];
        $message = $_POST['message'];

        $query = "INSERT INTO messages(`sender_id`,`receiver_id`,`message`,`read`,`created_at`,`updated_at`)VALUES('$userId','$receiverId','$message','no','$today','$today')";
        $con->query($query) or die($con->query);

        $query = "SELECT * FROM messages WHERE id = LAST_INSERT_ID()";
        $message = $con->query($query) or die($con->error);
        $messageRow = $message->fetch_assoc();

        echo json_encode($messageRow);
    }else{
        echo 'index.html';
    }
?>