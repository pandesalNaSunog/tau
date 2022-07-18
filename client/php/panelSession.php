<?php

    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        session_start();
        if(!isset($_SESSION['user_id'])){
            echo '';
        }else{
            echo 'ok';
        }
    }else{
        echo header('HTTP/1.0 403 Forbidden');
    }
    
?>