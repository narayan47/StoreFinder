<?php
include("connection.php");
    session_start();
    $user=$_SESSION["id"];
    $data = "DELETE FROM tm_login_user WHERE user_id = $user";
    $result = mysqli_query($conn, $data);
    session_unset();
    session_destroy();
    header("Location:index.php");
    exit;
?>