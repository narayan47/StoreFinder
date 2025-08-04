this is only for prectise
<?php
    session_start();
    include("connection.php");
    $id=(int)$_SESSION["id"];
    $data="SELECT user_fname from tm_user where user_id=$id";
    $result=$conn->query($data);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        if($row["user_fname"]!="")
            echo $row["user_fname"];
    }
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
                echo "<div class='row'>";
            }
            echo"
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
        <a href='details.php?shop=$shop_id' class='btn btn-secondary my-1'>Details</a>
        <a href='update_shopinfo.php?shop=$shop_id' class='btn btn-success my-1 mx-1'>Update</a>
        <a href='delete_shop.php?shop=$shop_id' class='btn btn-danger my-1 mx-1'>Delete</a>
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

     $conn->close();

?>


<?php
     $search_head=include("search_header.php.");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Deshbord</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
   
  <script>
    $(document).ready(function(){
        $.ajax({
            url:'user_data.php',
            type:'post',
            success:function(response){
              const userindx=response.indexOf("<div");
              if(userindx !==-1)
            {
               const name=response.substring(0,userindx);
              const card=response.substring(userindx);
                $("#user_name").text(`welcome, ${name}`);
                $("#shop_data").html(card);

            }
            else
            {
              const name=response;
              $("#user_name").text(`welcome, ${name}`);
              $("#shop_data").html("<h2 id='your_store'>No shop found. Start by creating one!</h2><a href='new_shopinfo.php' class='btn btn-success rounded-3 w-auto ' title='Create' id='create'><i class='bi bi-plus-circle fs-2'></i></a>")
            }
            }
        });
    })

       function Deleteuser(){
        if(confirm("Are you sure you want to delete this account ?"))
      {
            $.ajax({
              url:'delete_user.php',
              type:'post',
              success:function()
              {
              }
            })
      }
      }
  </script>
  <style>
     nav{
            background-color: #0d2931;
        }
         #img
        {
        border-radius:50%;
         height:26%;
          width:26%;
          margin-left:30px;
}
#store{
    font-size: 70px;
    margin-left:5%;
    color: orange;
    text-shadow: 5px 5px 4px rgba(0, 0, 0, 0.6);
    text-align: center;
}
#card{
  width: 22rem;margin-left:22px;
}
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css");
  #your_store{
    padding:70px 70px;
    text-align: center;
  }
  #create{
    margin-left:50%;
    margin-bottom: 30px;
  }
#user_name{
    color:white;
    font-family: 'Poppins', sans-serif;
    margin-right: 20px;
}
          @media (max-width: 576px) {
            #store{
    font-size: 40px;
    margin-left:5%;
}
#delete{
  font-size: 10px;
}
#txt_delete{
  font-size:12px;
}
#user_name{
    color:white;
    font-family: 'Poppins', sans-serif;
    margin-left: 20px;
}
          }
  @media(max-width:430px)
  {
    #card{
  width: 20rem;margin-left:2px;
}

#user_name{
    color:white;
    font-size:18px;
    font-family: 'Poppins', sans-serif;
    margin-left: 5px;
}
  }
           @media (max-width: 390px){

              #delete{
  font-size: 9px;
  margin-right: 50px;
}
#txt_delete{
  font-size:16px;
}
#user_name{
    color:white;
    font-family: 'Poppins', sans-serif;
    font-size:20px;
    margin-left: 10px;
}
#card{
  width: 20rem;margin-left:2px;
}

           }
           @media (max-width: 360px){
              #delete{
  font-size: 9px;
  margin-left:-100px;
}
#txt_delete{
  font-size:13px;
  margin-right:70px;
}
#user_name{
    color:white;
    font-family: 'Poppins', sans-serif;
    font-size:16px;
}
#store{
    font-size: 35px;
    margin-left:5%;
}
#card{
  width: 18rem;margin-left:2px;
}
           }

    @media (max-width: 360px){
      #card{
  width: 16rem;margin-left:2px;
}
    }
   @media (max-width: 375px){
      #card{
  width: 18rem;margin-left:2px;
}
    }

    .search
    {
      width: 40%;
    }
  </style>
</head>
<body style="padding-top: 100px;">
<!-- Toggle Button -->
<nav class='navbar bg-s fixed-top'>
  <a data-bs-toggle="offcanvas" data-bs-target="#leftSidebar" class="mx-1" id="image">
  <i class="bi bi-list mx-4" style="font-size: 30px;"></i>
</a>
     $search_head
  <div><h3 id="user_name"></h3></div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="leftSidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body ">
    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link text-dark fs-4" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link text-dark fs-4 " href="aboutus.php">AboutUs</a></li>
      <li class="nav-item"><a class="nav-link text-dark fs-4 " href="new_shopinfo.php">Create</a></li>
      <li class="nav-item"><a href='logout.php' class='nav-link text-dark fs-4'  id='logout'>LogOut</a></li>
    </ul>
  </div>
</div>
<div>

    <h2 id="store"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5F-8KMK7UHDC_6TV7xBkeKymBIP7EUOcDIg&s" alt="new shop" height="150" width="130">Your Shop</h2>
</div>
<div class="bg shadow m-4 "  id="shop_data">
</div>

 <div class="navbar bg bg-light shadow m-4">
       <h5 class="text-danger mx-5" id="txt_delete">Delete Your Account</h5>
       <a href="logout.php" class="btn btn-danger mx-5 " onclick="Deleteuser()" id="delete">Delete</a>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
