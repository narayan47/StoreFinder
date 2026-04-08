<?php
    $server="your_server";
    $user="user_name";
    $password="password";
    $database="databasename";
    $conn=new mysqli($server, $user, $password, $database);
    if($conn->connect_error){
        echo "Connection Fail";
    }
?>
