 <?php
        session_start();
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try{
                include("connection.php");
                 $folder = 'uploads/profile/';
        $images = glob($folder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
         $randomImage = $images[array_rand($images)];
         $filename = basename($randomImage);
                $s_fname=$_POST["fname"];
                $s_lname=$_POST["lname"];
                $fullname=$s_fname." ".$s_lname;
                $s_email=$_POST["s_email"];
                $s_password=$_POST["s_password"];
                $phone=$_POST["s_phone"];
                $user_email="SELECT user_id,user_email FROM tm_user WHERE user_email='$s_email'";
                $user_contact="SELECT user_id,user_contact FROM tm_user WHERE user_contact='$phone'";
                $latest_userid="SELECT user_id FROM tm_user ORDER BY user_id DESC Limit 1";
                $latest_id=$conn->query($latest_userid);
                $row = $latest_id->fetch_assoc(); 
                $user_id=$row["user_id"];
                $curent_user=(int)$user_id+1;
                $user_email_result=$conn->query($user_email);
                $user_contact_result=$conn->query($user_contact);
                if($user_email_result->num_rows<=0 && $user_contact_result->num_rows<=0)
                {
                    echo "not exist";
                    $_SESSION["id"]=$curent_user;
                    $sql=$conn->prepare("INSERT INTO tm_user (user_fname,user_lname,user_fullname,user_email,user_password,user_contact,profile_img)VALUES(?,?,?,?,?,?,?);");
                    $sql->bind_param("sssssss",$s_fname,$s_lname,$fullname,$s_email,$s_password,$phone,$filename);
                    $sql->execute(); 
                }
                 else
                 {
                        if($user_email_result->num_rows>0)
                        {
                            echo "email exist";
                        }
                        elseif($user_contact_result->num_rows>0)
                        {
                            echo "contact exist";
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
