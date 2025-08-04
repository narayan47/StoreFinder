 <?php
 session_start();
 $_SESSION["email"]=$_POST["s_email"];
        //Sign Up
            try{
                include("connection.php");
                $s_email=$_POST["s_email"];
                $user_email="SELECT user_id,user_email FROM tm_user WHERE user_email='$s_email'";
                $user_email_result=$conn->query($user_email);
                if($user_email_result->num_rows<=0)
                {
                    echo "not exist";
                }
                 
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            finally{
            }
            
         $conn->close();
   ?>
