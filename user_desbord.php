  <?php
      session_start();  
      if(!isset($_SESSION["id"]))
      {
          header("location:registration.php");
          exit;
      }

     if (isset($_SESSION["id"]) && $_SESSION["id"] == 1) {
    header("Location: admin.php");
    exit;
}
    $search_head=include("search_header.php.");
    $search=include("search.php.");
    $id=(int)$_SESSION["id"];
      include("connection.php");
      $data="SELECT user_fname,user_fullname,profile_img from tm_user where user_id=$id";
      $result=$conn->query($data);
      if($result->num_rows>0){
          $row = $result->fetch_assoc();
          $fname= $row["user_fullname"];
          $f_name= $row["user_fname"];
          $p_img= $row["profile_img"];
      }
      $shop_data="SELECT * FROM tm_shopinfo where shopkeeper_id=$id";
      $shop_result=$conn->query($shop_data);
      $total_shop=0;
      if($shop_result->num_rows> 0){
          $total_shop=$shop_result->num_rows;
      }
  echo"
  <!DOCTYPE html>
  <html lang='en'>
  <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>User Deshbord</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr' crossorigin='anonymous'>
      <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q' crossorigin='anonymous'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
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
      .this_card:hover {
      transform: scale(1.05); /* Zoom effect */
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
      z-index: 2;
    }
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
  </head>
  <body style='padding-top: 100px;'>";

  echo"
  <div class='fixed-top'>
  <nav class='navbar bg-s'>
    <a data-bs-toggle='offcanvas' data-bs-target='#leftSidebar' class='ms-1' id='image'>
    <i class='bi bi-list ms-4' id='ham'></i>
  </a>
    <div id='shearch_div'>$search_head</div>
    <div><h3 id='user_name'>Welcome,$f_name</h3></div>
    <div id='sh_log' class='me-4'><button style='border:none;background:none'><i class='bi bi-search text-success' id='sx'></i></button></div>
  </nav>
  <div id='shearch_divs' class='my-2 mx-2'>$search</div>
  </div>
  <div class='offcanvas offcanvas-start' tabindex='-1' id='leftSidebar'>
    <div class='offcanvas-header'>
      <h5 class='offcanvas-title'>Menu</h5>
      <button type='button' class='btn-close' data-bs-dismiss='offcanvas'></button>
    </div>
    <div class='offcanvas-body '>
      <ul class='nav flex-column'>
        <li class='nav-item'><a class='nav-link text-dark fs-4' href='index.php'>Home</a></li>
        <li class='nav-item'><a class='nav-link text-dark fs-4 ' href='aboutus.php'>AboutUs</a></li>
        <li class='nav-item'><a class='nav-link text-dark fs-4 ' href='new_shopinfo.php'>Create</a></li>
        <li class='nav-item'><a href='logout.php' class='nav-link text-dark fs-4'  id='logout'>LogOut</a></li>
      </ul>
    </div>
  </div>
  <div class='container shadow my-4 rounded-4'>
    <div class='row align-items-center py-4 px-2 gy-3 text-center text-md-start'>
      <div class='col-12 col-md-3 col-lg-2'>
        <img src='uploads/profile/{$p_img}' class='img-fluid rounded-3 border' id='user' style='max-width: 120px;' alt='Profile Image'>
      </div>

      <div class='col-12 col-md-6 col-lg-6'>
        <h3 class='nm mb-2'> $fname</h3>
        <h5 class='nm text-muted'>Total Shops:  $total_shop </h5>
      </div>

      <div class='col-12 col-md-3 col-lg-4 text-md-end'>
            <button class='btn btn-success'><a href='update_profile.php'  style='text-decoration:none;' class='text-dark'>Edit Profile</a></button>
    </div>
    </div>
  </div>
  ";

  echo"
      <h2 id='store'><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5F-8KMK7UHDC_6TV7xBkeKymBIP7EUOcDIg&s' alt='new shop' id='sp'>Your Shops</h2>
  </div>";
  echo"
  <div class='bg shadow m-4 '  id='shop_data'>";
    $count=0;

      $shop_data="SELECT * FROM tm_shopinfo where shopkeeper_id=$id";
      $shop_result=$conn->query($shop_data);
      if($shop_result->num_rows>0){
          while($shop_row=$shop_result->fetch_assoc()){
              $title=$shop_row["shop_title"];
              $shop_id=$shop_row["shop_id"];
              $location=$shop_row["shop_location"];
              $image=$shop_row["shop_image"];
              $view=$shop_row["views"];
              if($count%4==0)
              {
                  echo "<div class='row g-4 mx-1'>";
              }
              echo"
          <div class='col-md-3 col-sm-6 mb-5 mt-5 d-flex this_card'>
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
          <a href='update_shopinfo.php?shop=$shop_id' class='btn btn-sm btn-success my-1 '>Update</a>
          <a href='delete_shop.php?shop=$shop_id' class='btn btn-sm btn-danger my-1 '>Delete</a>
        </div>
      </div>
    </div>
  </div>
      ";
              $count++;
              if($count%4==0)
              {
                  echo "</div>";
              }
          }
          if($count%4!=0)
          {
              echo"</div>";
          }
      }
      else
      {
        echo "<h2 id='your_store'>No shop found. Start by creating one!</h2><a href='new_shopinfo.php' class='btn btn-success rounded-3 w-auto ' title='Create' id='create'><i class='bi bi-plus-circle fs-2'></i></a>";
      }
  echo"
  </div>
  <div class='navbar bg bg-light shadow m-4'>
        <h5 class='text-danger ms-4' id='txt_delete'>Delete Your Account</h5>
        <a href='logout.php' class='btn btn-danger btn-sm me-5 ' onclick='Deleteuser(event)' id='delete'>Delete</a>
          </div>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
  <script>
setInterval(() => {
  fetch('update_activity.php');
}, 2000);
</script>
  </body>
  </html>
  ";

  $conn->close();

  ?>