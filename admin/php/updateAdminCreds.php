<?php
    $con = new mysqli("localhost","u568496919_tau","Tauconnect11","u568496919_tau_db");
    $password = password_hash('adminpassword', PASSWORD_DEFAULT);
    $query = "UPDATE users SET email = 'tauAdmin@gmail.com', password = '' WHERE id = '1'";
    $con->query($query) or die($con->error);
?>