       
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
    $user_data="SELECT * FROM tm_user";
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
        <title>Store Finder | Admin Shops</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="icon" type="image/png" href="favicons.png" >

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

        <!-- PAGE LEVEL STYLES -->
         <script>
setInterval(() => {
  fetch('update_activity.php');
}, 2000);
</script>
           <script>
      $(document).ready(function() {
      $('#shearch_divs').hide();
     $('#sh_log').hide();
     var width = $(window).width();
    var height = $(window).height();
    if(width<=1024)
    {
      $('#shearch_div').hide();
       $('#sh_log').show();
  }
        $(document).on('click','#sh_log',function(){
        $('#shearch_divs').toggle();
        $('#sx').toggleClass('bi bi-x text-danger fs-2');
});
  $('#res').hide();
   $(document).on('keyup', '#input', function () {
    const inputValue = $(this).val();
    if (inputValue.length >= 1) {
        $.ajax({
            url: 'search_result.php',
            type: 'post',
            data: $('#search_data').serialize(),
            success: function (response) {
                $('#res').html(response).show();
            }
        });
    } else {
        $('#res').hide();
    }
});
});
    function Deleteuser(e){
            e.preventDefault();
          if(confirm('Are you sure you want to delete this account ?'))
        {
              $.ajax({
                url:'delete_user.php',
                type:'post',
                success:function()
                {
                alert('Your account has been deleted.');
                  window.location.href = 'logout.php';
                }
              })
        }
        }
    </script>
    <style>
      #your_store{
    padding:70px 70px;
    text-align: center;
  }
     #create{
    margin-left:50%;
    margin-bottom: 30px;
  }
     #search_divs{
            max-width:100%; 
            background-color:blue;

        }
  #res {
    position: absolute; 
    z-index: 9999;       
    overflow-y: auto;   
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    color: white;      
  }

  #li{
      border-radius:20px;
      margin-top:2px;
  }
            #li:hover{
      color:red;
      background-color:yellow;
  }
    nav{
              background-color: #0d2931;
          }
              #ham{
  font-size: 30px; 
    }
  #store{
      font-size: 70px;
      margin-left:5%;
      color: orange;
      text-shadow: 5px 5px 4px rgba(0, 0, 0, 0.6);
      text-align: center;
  }
      #user_name{
      color:white;
      font-family: 'Poppins', sans-serif;
      margin-right: 20px;
  }
  #card{
    width: 22rem;margin-left:20px;
  }
  @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css');
    #your_store{
      padding:70px 70px;
      text-align: center;
    }
    

  #user{
  width:80px;
  height:80px;
    }
    #sp{
        width:80;
        height:100;
    } 
    @media (max-width: 430px) {
     #create{
    margin-left:45%;
    margin-bottom: 30px;
  }
      #ham{
  font-size: 20px; 
    }
    #user_name{
      font-size: 12px;
    }
        #sp{
        width:110px;
        height:50;
    }
        #store{
      font-size: 37px;
      margin-left:5%;
  }
    }

  @media (max-width: 390px) {
  #ham{
  font-size: 20px; 
    }
        #sp{
        width:60px;
        height:50;
    }
        #store{
      font-size: 25px;
      margin-left:5%;
  }
      #txt_delete{
        font-size:12px;
    }

    }
  @media (max-width: 540px) {
        #sp{
        width:130px;
        height:50;
    }
        #store{
      font-size: 40px;
      margin-left:5%;
  }
  
    }
    </style>
        <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <li class="panel active">
                    <a href="admin_shops.php" >
                      <i class="bi bi-shop"></i>  Your Shops
	   
                       
                    </a>                   
                </li>
                  <li class="panel">
                    <a href="shops.php" >
                       <i class="bi bi-shop"></i>  Shops
	   
                       
                    </a>                   
                </li>
                 <li class="panel ">
                        <a href="category.php" >
                         <i class=" icon-chevron-right icon-2x"></i>  Category    
        
                        
                        </a>                   
                    </li>
                 <li class="panel">
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
            <div id="content"   >

                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">


                            <h2> Admin Shops  </h2>



                        </div>
                    </div>

                    <hr />
                    

<?php
$id = (int)$_SESSION["id"];
include("connection.php");

// Fetch logged-in user details
$data = "SELECT user_fname, user_fullname, profile_img FROM tm_user WHERE user_id = $id";
$result = $conn->query($data);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row["user_fullname"];
    $f_name = $row["user_fname"];
    $p_img = $row["profile_img"];
}

// Count shops
$shop_data = "SELECT * FROM tm_shopinfo WHERE shopkeeper_id = $id";
$shop_result = $conn->query($shop_data);
$total_shop = ($shop_result->num_rows > 0) ? $shop_result->num_rows : 0;
?>

<div class="container shadow my-4 rounded-4">
    <div class="row align-items-center py-4 px-2 gy-3 text-center text-md-start">
        <div class="col-12 col-md-3 col-lg-2">
            <img src="uploads/profile/<?php echo $p_img; ?>" class="img-fluid rounded-3 border" id="user" style="max-width: 120px;" alt="Profile Image">
        </div>

        <div class="col-12 col-md-6 col-lg-6">
            <h3 class="nm mb-2"><?php echo $fname; ?></h3>
            <h5 class="nm text-muted">Total Shops: <?php echo $total_shop; ?></h5>
        </div>

        <div class="col-12 col-md-3 col-lg-4 text-md-end">
            <a href="update_profile.php" class="btn btn-success text-dark" style="text-decoration:none;">Edit Profile</a>
        </div>
    </div>
</div>

<h2 id='store'>
    <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5F-8KMK7UHDC_6TV7xBkeKymBIP7EUOcDIg&s' alt='new shop' id='sp'>
    Your Shops
</h2>

<div class='bg shadow m-4' id='shop_data'>
<?php
$count = 0;
$shop_data = "SELECT * FROM tm_shopinfo WHERE shopkeeper_id = $id";
$shop_result = $conn->query($shop_data);

if ($shop_result->num_rows > 0) {
    while ($shop_row = $shop_result->fetch_assoc()) {
        $title = $shop_row["shop_title"];
        $shop_id = $shop_row["shop_id"];
        $location = $shop_row["shop_location"];
        $image = $shop_row["shop_image"];
        $view = $shop_row["views"];

        if ($count % 4 == 0) {
            echo "<div class='row g-4 mx-1'>";
        }

        echo "
        <div class='col-md-3 col-sm-6 mb-5 mt-5 d-flex'>
            <div class='card w-100 h-100 d-flex flex-column' id='card'>
                <div style='position: relative;'>
                    <span class='bg-light px-3 py-1 rounded-3 d-flex align-items-center gap-2 shadow' style='position: absolute; top: 10px; right: 10px; z-index: 2;'>
                        <i class='bi bi-eye text-danger fs-5'></i><span class='text-dark fs-5'>$view</span>
                    </span>
                    <a href='details.php?shop=$shop_id'>
                        <img src='uploads/shop_img/{$image}' class='card-img-top' style='height: 200px; width: 100%; object-fit: cover;' alt='shop img'>
                    </a>
                </div>

                <div class='card-body d-flex flex-column justify-content-between'>
                    <div>
                        <a href='details.php?shop=$shop_id' style='text-decoration:none;'>
                            <h5 class='card-title'><i class='bi bi-shop-window text-danger'></i> $title</h5>
                        </a>
                        <a href='details.php?shop=$shop_id' style='text-decoration:none;'>
                            <p class='card-text mt-2'><i class='bi bi-geo-alt-fill fs-5 text-danger'></i> $location</p>
                        </a>
                    </div>
                    <div class='mt-auto'>
                        <a href='details.php?shop=$shop_id' class='btn btn-sm btn-secondary my-1'>Details</a>
                        <a href='update_shopinfo.php?shop=$shop_id' class='btn btn-sm btn-success my-1'>Update</a>
                        <a href='delete_shop.php?shop=$shop_id' class='btn btn-sm btn-danger my-1'>Delete</a>
                    </div>
                </div>
            </div>
        </div>";

        $count++;
        if ($count % 4 == 0) {
            echo "</div>";
        }
    }

    if ($count % 4 != 0) {
        echo "</div>"; // close the last row if not filled
    }
} else {
    echo "<h2 id='your_store'>No shop found. Start by creating one!</h2>
    <a href='new_shopinfo.php' class='btn btn-success rounded-3 w-auto' title='Create' id='create'>
        <i class='bi bi-plus-circle fs-2'></i>
    </a>";
}
?>
</div>
<?php $conn->close(); ?>

                   
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
