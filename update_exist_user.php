 <?php
        session_start();
        $id = $_SESSION["id"];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try{
                include("connection.php");
                $s_email=$_POST["email"];
                $phone=$_POST["contact"];
                $user_email="SELECT user_id,user_email FROM tm_user WHERE user_id!=$id";
                $user_contact="SELECT user_id,user_contact FROM tm_user WHERE user_id!=$id";
                $user_email_result=$conn->query($user_email);
                $user_contact_result=$conn->query($user_contact);
                if($user_email_result->num_rows<=0 && $user_contact_result->num_rows<=0)
                {
                    echo "not exist";
                }
                 else
                 {
                    while($row=$user_contact_result->fetch_assoc())
                    {
                        $contact=$row["user_contact"];
                        if($contact==$phone)
                        {
                            echo "contact";
                            exit;
                        }
                    }
                    while($row=$user_email_result->fetch_assoc())
                    {
                        $email=$row["user_email"];
                         if($email==$s_email)
                        {
                            echo "email";
                            exit;
                        }
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
