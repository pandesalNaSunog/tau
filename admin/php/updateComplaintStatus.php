<?php
    session_start();
    include('connection.php');
    $con = connect();

    if(isset($_POST) && isset($_SESSION['admin_id'])){
        $complaintId = $_POST['complaint_id'];

        $query = "UPDATE complaints SET status = 'ACKNOWLEDGED' WHERE id = '$complaintId'";
        $con->query($query) or die($con->error);

        echo 'ok';
    }else{
        echo 'index.html';
    }
?>