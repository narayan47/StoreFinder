<?php
    include("connection.php");
    $data="SELECT shop_id,shop_title,shop_location,shop_image,views from tm_shopinfo ORDER BY views DESC LIMIT 4";
    $result=$conn->query($data);
    $count=0;
    if($result->num_rows>0){
        while($shop_row=$result->fetch_assoc()){
            $title=$shop_row["shop_title"];
            $shop_id=$shop_row["shop_id"];
            $location=$shop_row["shop_location"];
            $image=$shop_row["shop_image"];
            $view=$shop_row["views"];
            if($count%4==0)
            {
                echo "<div class='row mx-1'>";
            }
            echo"
     <div class='col-lg-3 col-md-6 col-sm-12 mb-4 this_card'>
     <a href='details.php?shop=$shop_id' style='text-decoration:none;'>
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

     $conn->close();
?>