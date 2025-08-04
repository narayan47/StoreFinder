<?php
    $server="localhost";
    $user="root";
    $password="";
    $database="db_storefinder";
    $conn=new mysqli($server, $user, $password, $database);
    if($conn->connect_error){
        echo "Connection Fail";
    }
?>