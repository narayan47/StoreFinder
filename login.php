<?php
    session_start();
   include("connection.php");
     $email_contact=$_POST["emailorcontact"];
    $password=$_POST["password"];
    $user_data="SELECT user_id FROM tm_user where (user_email='$email_contact' or user_contact='$email_contact') and user_password='$password'";
    $user_email_contact="SELECT user_email,user_contact FROM tm_user where user_email='$email_contact' or user_contact='$email_contact'";
    $user_email_contact_result= mysqli_query($conn,$user_email_contact);
    $result=mysqli_query($conn,$user_data);
    $row = $result->fetch_assoc();
    if(mysqli_num_rows($result)>0)
    {
        $_SESSION["id"] = $row["user_id"];
        echo "exist";
    }
    else
    {
          if(mysqli_num_rows($user_email_contact_result)>0)
        {
            echo "password not  exist";
        }
        else
        {
            echo "not exist";
        }
    }

 $conn->close();

?>