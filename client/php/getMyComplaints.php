<?php
    session_start();
    include('connection.php');
    $con = connect();

    if(isset($_GET) && isset($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
        $query = "SELECT * FROM complaints WHERE user_id = '$userId'";
        $complaint = $con->query($query) or die($con->error);
        $complaints = array();
        while($row = $complaint->fetch_assoc()){
            $date = date_create($row['created_at']);
            $date = date_format($date, "M d, Y h:i A");
            $complaints[] = array(
                'complaint' => $row['complaint'],
                'status' => $row['status'],
                'date' => $date
            );
        }

        echo json_encode($complaints);
    }else{
        echo 'index.html';
    }
?>