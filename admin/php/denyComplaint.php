<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();

        if(isset($_POST)){
            $complaintId = $_POST['complaint_id'];


            $query = "SELECT * FROM complaints WHERE id = '$complaintId'";
            $complaint = $con->query($query) or die($con->error);
            $complaintRow = $complaint->fetch_assoc();

            $complaintStatus = $complaintRow['status'];

            if($complaintStatus == "DENIED"){
                echo 'already denied';
            }else{
                $query = "UPDATE complaints SET status = 'DENIED' WHERE id = '$complaintId'";
                $con->query($query) or die($con->error);
                echo 'ok';
            }
            
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>