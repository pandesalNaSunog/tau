<?php
    session_start();
    if(!isset($_SESSION['admin_id'])){
        echo 'index.html';
    }
?>