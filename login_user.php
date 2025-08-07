    <?php   
      session_start();
     if(!isset($_SESSION["id"]))
      {
          header("location:registration.php");
          exit;
      } 
       if (isset($_SESSION["id"]) && $_SESSION["id"] != 1) {
    header("Location: errors_404.html");
    exit;
}
    include("connection.php"); 
    $user_data="SELECT user_id FROM tm_login_user";
        $user_result=$conn->query($user_data);
 $admin_data="SELECT user_id,user_fullname,profile_img FROM tm_user where user_id=1";
    $admin_result=$conn->query($admin_data);
     if($admin_result->num_rows>0){
    $row=$admin_result->fetch_assoc();
    $adminfullname=$row["user_fullname"];
    $adminimg=$row["profile_img"];
     } 
    ?>


    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- BEGIN HEAD -->
    <head>
        <meta charset="UTF-8" />
        <title>Store Finder | Login Users</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel='icon' type='image/png' href='favicons.png' >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <!-- GLOBAL STYLES -->
        <!-- GLOBAL STYLES -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
        <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
        <!--END GLOBAL STYLES -->

        <script>
setInterval(() => {
  fetch('update_activity.php');
}, 2000);
</script>
        <!-- PAGE LEVEL STYLES -->
        <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
          <script>
         function Deleteuser(e){
          if(confirm('Are you sure you want to delete User?'))
        {
        }
        else
        {
                  e.preventDefault();
        }
        }
     </script>
        <!-- END PAGE LEVEL  STYLES -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
        <!-- END HEAD -->
        <!-- BEGIN BODY -->
    <body class="padTop53 " >

        <!-- MAIN WRAPPER -->
        <div id="wrap">


            <!-- HEADER SECTION -->
            <div id="top">

                <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                    <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                        <i class="icon-align-justify"></i>
                    </a>
                    <!-- LOGO SECTION -->
                     <header class="navbar-header">

                       <a href="" class="navbar-brand">
                    <img src="store_finder_logo_240x40.png" alt="" />
                        
                        </a>
                    </header>
                    <!-- END LOGO SECTION -->
                    <ul class="nav navbar-top-links navbar-right">
                        <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="update_profile.php"><i class="icon-user"></i>Edit Profile </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                        <!--END ADMIN SETTINGS -->
                    </ul>

                </nav>

            </div>
            <!-- END HEADER SECTION -->



            <!-- MENU SECTION -->
        <div id="left">
                <div class="media user-media well-small">
                <a class="user-link" href="admin.php">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="uploads/profile/<?php echo $adminimg;  ?>" width="80" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"> </h5>
                    <ul class="list-unstyled user-info">
                         <?php  echo $adminfullname ; ?>
                        <li>
                             <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                           
                        </li>
                       
                    </ul>
                </div>
                <br />
            </div>
<ul id="menu" class="collapse">

                
                <li class="panel ">
                    <a href="admin.php" >
                        <i class="icon-table"></i> Dashboard
	   
                       
                    </a>                   
                </li>
                <li class="panel">
                    <a href="index.php" >
                        <i class="icon-home"></i> Home
	   
                       
                    </a>                   
                </li>
                   <li class="panel">
                    <a href="new_shopinfo.php" >
                        <i class="icon-plus"></i> Create
	   
                       
                    </a>                   
                </li>
                <li class="panel">
                    <a href="admin_shops.php" >
                      <i class="bi bi-shop"></i>  Your Shops
	   
                       
                    </a>                   
                </li>
                  <li class="panel">
                    <a href="shops.php" >
                       <i class="bi bi-shop"></i>  Shops
	   
                       
                    </a>                   
                </li>
                 <li class="panel  ">
                        <a href="category.php" >
                         <i class=" icon-chevron-right icon-2x"></i>  Category    
        
                        
                        </a>                   
                    </li>
                 <li class="panel">
                        <a href="users.php" >
                         <i class="icon-user icon-2x"></i>  Users
                        
                        </a>                   
                    </li>
                    <li class="panel active ">
                        <a href="login_user.php" >
                         <i class="icon-user icon-2x"></i>  Login User
        
                        
                        </a>                   
                    </li>

            </ul>

            </div>
            <!--END MENU SECTION -->


            <!--PAGE CONTENT -->
            <div id="content"   >

                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">


                            <h2> Login Users </h2>



                        </div>
                    </div>

                    <hr />


                    <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                All Users
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>password</th>
                                                <th>Contact</th>
                                                <th>Role</th>
                                                <th>Image</th> 
                                                <th>Delete</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
    if($user_result->num_rows > 0)
    {
        
        while($rows=$user_result->fetch_assoc()){
            $u_id=$rows["user_id"];
               $u_data="SELECT * FROM tm_user where user_id=$u_id";
        $u_result=$conn->query($u_data);
        if($u_result->num_rows > 0)
    {
        
        while($row=$u_result->fetch_assoc()){
            $user_id=$row["user_id"];
            $fname=$row["user_fname"];
            $lname=$row["user_lname"];
            $fullname=$row["user_fullname"];
            $email=$row["user_email"];
            $password=$row["user_password"];
            $contact=$row["user_contact"];
            $role=$row["user_role"];
            $img=$row["profile_img"];

                                        echo"
                                                <tr class='odd gradeX'>
                                                <td>$fname</td>
                                                <td>$lname</td>
                                                <td><a href='user_profile.php?u_id=$user_id' style='text-decoration:none;' class='d-flex align-items-center gap-2'>$fullname</a></td>
                                                <td>$email</td>
                                                <td class='center'>$password</td>
                                                <td class='center'>$contact</td>
                                                <td class='center'>$role</td>
                                                <td class='center'><img src='uploads/profile/{$img}' width='50'></td>
                                                <td><a href='admin_user_delete.php?id=$user_id' class='btn btn-sm btn-danger my-1 ' onclick='Deleteuser(event)'>Delete</a></td>
                                            </tr>

                                        ";
        }
        }
    }
}           

                                        ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            

                </div>




            </div>
        <!--END PAGE CONTENT -->


        </div>

        <!--END MAIN WRAPPER -->

    <!-- FOOTER -->
        <div id="footer">
            <p>&copy;  Copyright &nbsp;2025 &nbsp;</p>
        </div>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->
        <script src="assets/plugins/jquery-2.0.3.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- END GLOBAL SCRIPTS -->
            <!-- PAGE LEVEL SCRIPTS -->
        <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>
        <!-- END BODY -->
    </html>
