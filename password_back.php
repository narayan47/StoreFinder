<?php
    session_start();
    require_once("connection.php");
    $email= $_SESSION["email"];
          $pass=$_POST["pass"];
     $user_data="SELECT user_password FROM tm_user where user_email='$email'";
    $result=mysqli_query($conn,$user_data);
    if(mysqli_num_rows($result)>0)
    {
        $row = $result->fetch_assoc();
        $password=$row["user_password"];
        if($password==$pass)
        {
            echo "exist";
        }

    }
  



?>