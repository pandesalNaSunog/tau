<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        session_start();
        include('connection.php');
        $con = connect();

        if(isset($_POST) && isset($_SESSION['admin_id'])){
            $complaintId = $_POST['complaint_id'];


            $query = "SELECT * FROM complaints WHERE id = '$complaintId'";
            $complaint = $con->query($query) or die($con->error);
            $complaintRow = $complaint->fetch_assoc();

            $complaintStatus = $complaintRow['status'];

            if($complaintStatus == "ACKNOWLEDGED"){
                echo 'already acknowledged';
            }else{
                $query = "UPDATE complaints SET status = 'ACKNOWLEDGED' WHERE id = '$complaintId'";
                $con->query($query) or die($con->error);
    
                echo 'ok';
            }
            
        }else{
            echo 'index.html';
        }
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
?>