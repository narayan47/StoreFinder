 <?php
        //Sign Up
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try{
                include("connection.php");
                $s_fname=$_POST["fname"];
                $s_lname=$_POST["lname"];
                $s_email=$_POST["s_email"];
                $s_password=$_POST["s_password"];
                $phone=$_POST["s_phone"];
                $user_email="SELECT user_id,user_email FROM tm_user WHERE user_email='$s_email'";
                $user_contact="SELECT user_id,user_contact FROM tm_user WHERE user_contact='$phone'";
                $latest_userid="SELECT user_id FROM tm_user ORDER BY user_id DESC Limit 1";
                $latest_id=$conn->query($latest_userid);
                $user_email_result=$conn->query($user_email);
                $user_contact_result=$conn->query($user_contact);
                if($user_email_result->num_rows<=0 && $user_contact_result->num_rows<=0)
                {
                    echo "not exist";
                }
                 else
                 {
                        if($user_email_result->num_rows>0)
                        {
                            echo " exist email";
                        }
                        if($user_contact_result->num_rows>0)
                        {
                            echo " exist contact";
                        }
                 }    
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            finally{
            }
            
        }
         $conn->close();
   ?>
