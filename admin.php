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
    $shop_data="SELECT shop_id FROM tm_shopinfo ";
        $shop_result=$conn->query($shop_data);
        if($shop_result->num_rows>0){
        $shops=$shop_result->num_rows;
        } 

        $user_data="SELECT user_id FROM tm_user ";
        $user_result=$conn->query($user_data);
        if($user_result->num_rows>0){
        $user=$user_result->num_rows;
    
        
        } 

        $admin_data="SELECT user_id,user_fullname,profile_img FROM tm_user where user_id=1";
        $admin_result=$conn->query($admin_data);
        if($admin_result->num_rows>0){
        $row=$admin_result->fetch_assoc();
        $adminfullname=$row["user_fullname"];
        $adminimg=$row["profile_img"];
        } 

        $loguser_data="SELECT user_id FROM tm_login_user ";
        $loguser_result=$conn->query($loguser_data);
        if($loguser_result->num_rows>0){
        $loguser=$loguser_result->num_rows;
    
        
        } 


    ?>
    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="UTF-8" />
        <title>Store Finder | Dashboard </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel='icon' type='image/png' href='favicons.png' >
        <script>
    setInterval(function () {
    $.ajax({
        url: 'live_user.php',
        type: 'POST',
        success: function (response) {
        document.getElementById("live").innerText=response;
        },
        error: function () {
        console.log("Failed to update activity");
        }
    });
    }, 1000); 
    </script>
        <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <!-- GLOBAL STYLES -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
        <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
        <!--END GLOBAL STYLES -->

        <!-- PAGE LEVEL STYLES -->
        <link href="assets/css/layout2.css" rel="stylesheet" />
        <link href="assets/plugins/flot/examples/examples.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/plugins/timeline/timeline.css" />
        <!-- END PAGE LEVEL  STYLES -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script>
    setInterval(() => {
    fetch('update_activity.php');
    }, 2000);
    </script>
    </head>

    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body class="padTop53 " >

    <!-- MAIN WRAPPER -->
    <div id="wrap" >
        

        <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="admin.php" class="navbar-brand">
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
       <div id="left" >
            <div class="media user-media well-small">
                <a class="user-link" href="">
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

                
                <li class="panel active">
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
                 <li class="panel ">
                        <a href="users.php" >
                         <i class="icon-user icon-2x"></i>  Users
        
                        
                        </a>                   
                    </li>
                    <li class="panel ">
                        <a href="login_user.php" >
                         <i class="icon-user icon-2x"></i>  Login User
        
                        
                        </a>                   
                    </li>

            </ul>

        </div>
        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
        <div id="content">
             
            <div class="inner" style="min-height: 400px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Admin Dashboard </h1>
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">
                           
                            <a class="quick-btn">
                            <i class="bi bi-circle-fill text-danger"></i>  <i class="icon-user icon-2x"></i>
                                <span> Live User</span>
                                <span class="label label-danger" id="live"></span>
                            </a>
                            <a class="quick-btn" href="shops.php">
                                <i class="bi bi-shop icon-2x"></i>
                                <span>Shops</span>
                                <span class="label label-warning"><?php echo $shops; ?></span>
                            </a>
                            <a class="quick-btn" href="users.php">
                                <i class="icon-user icon-2x"></i>
                                <span>Users</span>
                                <span class="label btn-metis-4"><?php echo $user; ?></span>
                            </a>
                            <a class="quick-btn" href="login_user.php">
                                <i class="icon-user icon-2x"></i>
                                <span>Login Users</span>
                                <span class="label btn-metis-4"><?php echo $loguser; ?></span>
                            </a>
                            

                            
                            
                        </div>

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                  

                        </div>

                    </div>

                

    <!-- FOOTER -->
    <div id="footer">
        <p>&copy; Copyright &nbsp;2025 &nbsp;</p>
    </div>
    <!--END FOOTER -->


    <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot/jquery.flot.time.js"></script>
     <script  src="assets/plugins/flot/jquery.flot.stack.js"></script>
    <script src="assets/js/for_index.js"></script>
   
    <!-- END PAGE LEVEL SCRIPTS -->


</body>

    <!-- END BODY -->
</html>
