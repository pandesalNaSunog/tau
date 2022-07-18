<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        session_unset();
    }
    echo 'index.html';
?>