<?php
    session_start();
    require_once("connection.php");
    $email= $_SESSION["email"];
          $pass=$_POST["pass"];
    $sql = $conn->prepare("UPDATE tm_user SET user_password=? WHERE user_email=?");
$sql->bind_param("ss", $pass, $email);
$sql->execute();



?>