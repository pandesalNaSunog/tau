<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        echo '';
    }else{
        echo 'ok';
    }
?>