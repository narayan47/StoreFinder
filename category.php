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
    $user_data="SELECT category_id,category_name FROM shop_category";
        $user_result=$conn->query($user_data);
 $admin_data="SELECT user_id,user_fullname,profile_img FROM tm_user where user_id=1";
    $admin_result=$conn->query($admin_data);
     if($admin_result->num_rows>0){
    $row=$admin_result->fetch_assoc();
    $adminfullname=$row["user_fullname"];
    $adminimg=$row["profile_img"];
     } 


//fetch  data to edit record
if(isset($_GET["edit"]))
{
    $cat_id=$_GET["edit"];
    $qry="Select * from shop_category where category_id=".$cat_id;
    $rsedit=mysqli_query($conn,$qry);
    $erow=mysqli_fetch_row($rsedit);
    $catt_id=$erow[0];
    $catt_name=$erow[1];
}

    ?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Store Finder | Shop Category</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <link rel="icon" type="image/png" href="favicons.png" >

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
  
    <!-- PAGE LEVEL STYLES -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
     <link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" />
     <script>
         function Deletecategory(e){
          if(confirm('Are you sure you want to delete Category if you delete then shop related that category also delete ?'))
        {
        }
        else
        {
                  e.preventDefault();
        }
        }
        let isDuplicate=false;
         $(document).on("keydown","#required2",function()
    {
         $("#duplicat").html("");
            $("#required2").css("border","1px solid green");  
    })
        $(document).on("blur","#required2",function()
    {
            const cat=$(this).val().trim();
            $.ajax({
                url:"category_match.php",
                method:"Post",
                data:{cat_name:cat},
                success:function(response){
                    if(response.trim()=="duplicate")
                    {
                         isDuplicate=true;
                        $("#duplicat").html("<p style='color:red'>Duplicate Category Not allow</p>");
                        $("#required2").css("border","1px solid red");
                    }
                         else
        {
             isDuplicate=false;
         $("#duplicat").html("");
            $("#required2").css("border","1px solid green");  
        }
                }
            })
    })

     $(document).on("submit","#block-validate",function(e)
    {
        if(isDuplicate)
        {
            e.preventDefault();
        }
    });
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
                 <li class="panel active ">
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
           
                <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="<?php if(!isset($catt_id)) echo 'active';?>"><a href="#home" data-toggle="tab">Data</a>
                                </li>
                                <li class="<?php if(isset($catt_id)) echo 'active';?>"><a href="#profile" data-toggle="tab">New</a>
                                </li>       
                            </ul>

                            <div class="tab-content">
                                <div class="<?php if(!isset($catt_id)) echo'tab-pane fade in active'; else echo 'tab-pane fade';?>" id="home">
                                      <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                All Shop Category
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Category Name</th> 
                                                <th>Edit</th>
                                                <th>Delete</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
    if($user_result->num_rows > 0)
    {
        while($row=$user_result->fetch_assoc()){
            $cat_id=$row["category_id"];
            $cat_name=$row["category_name"];
           

                                        echo"
                                                <tr class='odd gradeX'>
                                                <td class='center'>$cat_name</td>
                                                 <td class='center' ><a href='category.php?edit=$cat_id' class='btn  btn-success my-1 '><i class='icon-edit'></i></a></td>
                                                <td class='center'><a href='category_delete?id=$cat_id' class='btn btn-danger my-1 ' id='delete'  onclick='Deletecategory(event)'><i class='icon-remove'></i></a></td>
                                            </tr>

                                        ";
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
                                <div class="<?php if(isset($catt_id)) echo'tab-pane fade in active'; else echo 'tab-pane fade';?>" id="profile">
                                      <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Shop Category</h5>
                                    <div class="toolbar">
                                        <ul class="nav">
                                            <li>
                                                <div class="btn-group">
                                                    <a class="accordion-toggle btn btn-xs minimize-box" data-toggle="collapse"
                                                        href="#collapseOne">
                                                        <i class="icon-chevron-up"></i>
                                                    </a>
                                                    <button class="btn btn-xs btn-danger close-box">
                                                        <i class="icon-remove"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </header>
                                <div id="collapseOne" class="accordion-body collapse in body">
                                    <form action="dbcategory.php" class="form-horizontal" id="block-validate" method="post" >

                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Category</label>
                                            <div class="col-lg-4">
                                                <input type="hidden" id="required2" name="cat_id" class="form-control" value="<?php if(isset($catt_id)) echo $catt_id; ?>" />
                                                <input type="text" id="required2" name="required2" class="form-control" value="<?php if(isset($catt_name)) echo $catt_name; ?>" />
                                                <span id="duplicat"></span>
                                            </div>
                                        </div>

                                        
                                        <div class="form-actions no-margin-bottom" style="text-align:center;">
                                            <input type="submit" value="<?php if(!isset($catt_id)) echo'add'; else echo 'update'; ?>"  class="btn btn-primary btn-lg " name="btn_submit" />
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <!-- PAGE LEVEL SCRIPTS -->

     <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="assets/js/validationInit.js"></script>
    <script>
        $(function () { formValidation(); });
        </script>
     <!--END PAGE LEVEL SCRIPTS -->
     
    <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
	 <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="assets/js/validationInit.js"></script>
      <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(function () { formValidation(); });
        </script>
           <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
</body>
     <!-- END BODY -->
</html>

