<?php
    include("header.php");
    include("connection.php");
    $id=(int)$_GET["u_id"];
    $data="SELECT user_fullname,profile_img from tm_user where user_id=$id";
    $result=$conn->query($data);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $fname= $row["user_fullname"];
        $p_img= $row["profile_img"];
    }
    $total_shop=0;
     $shop_data="SELECT * FROM tm_shopinfo where shopkeeper_id=$id";
    $shop_result=$conn->query($shop_data);
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
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
  <style>
    .this_card:hover {
      transform: scale(1.05); /* Zoom effect */
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
      z-index: 2;
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
  #user{
width:80px;
height:80px;
  }
  #sp{
      width:80;
      height:100;
  }
@import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css');
  #your_store{
    padding:70px 70px;
    text-align: center;
  }

   @media (max-width: 430px) {
   .nm{
font-size: 12px;
  }
#user{
width:40px;
height:40px;
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

@media (max-width: 375px) {
      #sp{
      width:80px;
      height:50;
  }
      #store{
    font-size: 25px;
    margin-left:5%;
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

echo"<div class='container shadow my-4'>
    <div class='row'>
        <div class='col-2 ms-5'>
        <div class='my-2'>
            <img src='uploads/profile/$p_img' id='user' class='rounded-3 border'>
            </div>
        </div>
        <div class='col-4'>
            <div class='row mt-2'>
                <h3 class='nm'>$fname</h3>
            </div>
            <div class='row'>
           <h5 class='nm'> Total Shops : $total_shop</h5>
            </div>
        </div>

    </div>

</div>";

echo"
    <h2 id='store'><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5F-8KMK7UHDC_6TV7xBkeKymBIP7EUOcDIg&s' alt='shop_img' id='sp'>All Shops</h2>
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
         <div class='col-lg-3 col-md-6 col-sm-12 mb-4 my-3 this_card'>
              <a href='details.php?shop=$shop_id'>
  <div class='card shop-card h-100'>
    <div style='position: relative;'>
      <span class='bg-light px-3 py-1 rounded-3 d-flex align-items-center gap-2 shadow' style='position: absolute; top: 10px; right: 10px; z-index: 2;'>
        <i class='bi bi-eye text-danger fs-5'></i><span class='text-dark fs-5'> $view</span>
      </span>
      <a href='details.php?shop=$shop_id'>
        <img src='uploads/shop_img/{$image}' class='card-img-top' alt='shop img' style='height: 200px; width: 100%; object-fit: cover;'>
      </a>
    </div>

    <div class='card-body d-flex flex-column justify-content-between'>
      <div>
        <a href='details.php?shop=$shop_id' style='text-decoration:none;'>
          <h5 class='card-title fs-5'><i class='bi bi-shop-window text-danger'></i> $title</h5>
        </a>
        <a href='details.php?shop=$shop_id' style='text-decoration:none;'>
          <p class='card-text mt-2 fs-5'><i class='bi bi-geo-alt-fill fs-5 text-danger'></i> $location</p>
        </a>
      </div>
    </div>
  </div>
  </a>
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

echo"
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