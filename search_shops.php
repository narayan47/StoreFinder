<?php
include("header.php");
include("connection.php");
 $count=0;
$search=$_GET['search'];
$category=$_GET['category'];

$Offset=(isset($_GET['offset']))?(int)$_GET['offset']:(isset($_GET['prev']) ? (int)$_GET['prev'] - 20 : 0);
if($category=="All")
{
     $shop_data="SELECT * FROM tm_shopinfo where (shop_location like '%$search%' or shop_title like '%$search%') limit 20 OFFSET $Offset";
    $shop_result=$conn->query($shop_data);
     echo"  
        <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
  <link rel='icon' type='image/png' href='favicons.png' >
  <script>
setInterval(() => {
  fetch('update_activity.php');
}, 2000);
</script>
   <style>
     .this_card:hover {
      transform: scale(1.05); /* Zoom effect */
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
      z-index: 2;
    }
        #card{
  width: 18rem;margin-left:30px;
}
  #ty{
margin-left:34%;font-size:30px
}
  @media(max-width:768px){

           #card{
  width: 13rem;margin-left:-40px;
} 
    }

  @media(max-width:820px){

           #card{
  width: 14rem;margin-left:-14px;
} 
    }   
@media(max-width:430px)
{
              #card{
  width: 15rem;margin-left:20px;
}
    }
@media(max-width:390px)
{
                  #card{
  width: 15rem;margin-left:4px;
}
   #ty{
margin-left:10%;font-size:16px
}
    }

   </style>
</head>
<body style='padding-bottom:50px;padding-top:100px'>

";
    if($shop_result->num_rows>0){
    $curent_rows=$shop_result->num_rows;
       $shop_rows="SELECT shop_id FROM tm_shopinfo where (shop_location like '%$search%' or shop_title like '%$search%');";
    $rows_result=$conn->query($shop_rows);
    $rows=$rows_result->num_rows;
    $row_number=ceil($rows/20);
    $start=$Offset+1;
    if($rows<=20)
    {
      $end=$rows;
    }
    else
    {
      $end=$Offset+$curent_rows;
    }
    if($shop_result->num_rows>0){
      echo"      <div class='shadow mx-5 my-3'>$start - $end of over $rows  results for '$search'</div>
        <div class='shadow mx-5'>
       <div>
";
        while($shop_row=$shop_result->fetch_assoc()){
            $title=$shop_row["shop_title"];
            $shop_id=$shop_row["shop_id"];
            $location=$shop_row["shop_location"];
            $image=$shop_row["shop_image"];
            $view=$shop_row["views"];
            if($count%4==0)
            {
                echo "<div class='row g-3 mx-1'>";
            }
            echo"
      <div class='col-lg-3 col-md-6 col-sm-12 mb-4 my-4 this_card'>
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
      if($rows<=20)
      {
           echo "<h4 class='text-success py-4' id='ty'>🔍 Thank you for searching! 😊</h4>";
      }
      else
      {
        
         echo"<nav aria-label='Page navigation example'>
  <ul class='pagination py-5 bg-white' style='padding-left:40%'>";
  if($Offset==0)
  {
    echo "<li class='page-item disabled'><a class='page-link' href='search_shops.php?prev=$Offset&search=$search&category=$category'>Previous</a></li>";
  }
  else
  {
     echo "<li class='page-item'><a class='page-link' href='search_shops.php?prev=$Offset&search=$search&category=$category'>Previous</a></li>";
  }
        for ($i = 1; $i <= $row_number; $i++) {
    $j = $i - 1;
    $num = $j * 20;
    $currentPage = floor($Offset / 20) + 1;
    if (
        $i == 1 || $i == $row_number || 
        ($i >= $currentPage - 2 && $i <= $currentPage + 2)
    ) {
        if ($i == $currentPage) {
            echo "<li class='page-item active'>
                    <a class='page-link' href='search_shops.php?offset=$num&search=$search&category=$category'>$i</a>
                  </li>";
        } else {
            echo "<li class='page-item'>
                    <a class='page-link' href='search_shops.php?offset=$num&search=$search&category=$category'>$i</a>
                  </li>";
        }
        $showDots = true;
    } elseif ($showDots) {
        // Show dots only once when needed
        echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
        $showDots = false;
    }
}
        $set=$Offset+20;
        if($set>=$rows)
        {
              echo"<li class='page-item disabled'><a class='page-link' href='search_shops.php?offset=$set&search=$search&category=$category'>Next</a></li></ul>
</nav>";
        }
        else
        {
          echo"<li class='page-item'><a class='page-link' href='search_shops.php?offset=$set&search=$search&category=$category'>Next</a></li></ul>
</nav>";
        }
        
  
      }
       

    
}
    }
   else {
    echo "<div class='shadow mx-5'><h2 class='mx-4 text-danger' style='text-align:center'>❌ No shops found for '<b>$search</b>'".$category."</h2>";
}
}
else
{
          $shop_data="SELECT * FROM tm_shopinfo where shop_category='$category' and (shop_location like '%$search%' or shop_title like '%$search%') limit 20 ;";
    $shop_result=$conn->query($shop_data);
    $curent_rows=$shop_result->num_rows;
    echo "    <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
   <link rel='icon' type='image/png' href='favicons.png' >
  <style>
    .this_card:hover {
      transform: scale(1.05); /* Zoom effect */
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
      z-index: 2;
    }
        #card{
  width: 22rem;margin-left:40px;
}
  @media(max-width:768px){

           #card{
  width: 13rem;margin-left:-40px;
} 
    }

  @media(max-width:820px){

           #card{
  width: 14rem;margin-left:-14px;
} 
    }   
@media(max-width:430px)
{
              #card{
  width: 15rem;margin-left:20px;
}
    }
@media(max-width:390px)
{
                  #card{
  width: 15rem;margin-left:4px;
}
    }

   </style>
</head>
<body style='padding-bottom:50px;padding-top:100px'>
    ";
    if($curent_rows> 0){
       $shop_rows="SELECT shop_id FROM tm_shopinfo where  shop_category='$category' and (shop_location like '%$search%' or shop_title like '%$search%');";
    $rows_result=$conn->query($shop_rows);
    $rows=$rows_result->num_rows;
    $row_number=ceil($rows/20);
    $start=$Offset+1;
    if($rows<=20)
    {
      $end=$rows;
    }
    else
    {
      $end=$Offset+$curent_rows;
    }
    if($shop_result->num_rows>0){
      echo"
      <div class='shadow mx-5 my-3'>$start - $end of over $rows  results for '$search'</div>
        <div class='shadow mx-5'>
       <div>
";
        while($shop_row=$shop_result->fetch_assoc()){
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
     <div class='col-lg-3 col-md-6 col-sm-12 mb-4 my-4 this_card'>
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
      if($rows<=20)
      {
           echo "<h4 class='text-success py-4' style='margin-left:34%;font-size:30px'>🔍 Thank you for searching! 😊</h4>";
      }
      else
      {
        
         echo"<nav aria-label='Page navigation example'>
  <ul class='pagination py-5 bg-white' style='padding-left:40%'>";
  if($Offset==0)
  {
    echo "<li class='page-item disabled'><a class='page-link' href='search_shops.php?prev=$Offset&search=$search&category=$category'>Previous</a></li>";
  }
  else
  {
     echo "<li class='page-item'><a class='page-link' href='search_shops.php?prev=$Offset&search=$search&category=$category'>Previous</a></li>";
  }
        for($i=1;$i<=$row_number;$i++)
        {
            $j=$i-1;
            $num=$j*20;
            if($num==$Offset)
            {
               echo"<li class='page-item active'><a class='page-link' href='search_shops.php?offset=$num&search=$search&category=$category'>$i</a></li>";
            }
            else
            {
              echo"<li class='page-item '><a class='page-link' href='search_shops.php?offset=$num&search=$search&category=$category'>$i</a></li>";
            }
           
        }
        $set=$Offset+20;
        if($set>=$rows)
        {
              echo"<li class='page-item disabled'><a class='page-link' href='search_shops.php?offset=$set&search=$search&category=$category'>Next</a></li></ul>
</nav>";
        }
        else
        {
          echo"<li class='page-item'><a class='page-link' href='search_shops.php?offset=$set&search=$search&category=$category'>Next</a></li></ul>
</nav>";
        }
        
  
      }
       

    
}
}
 else {
   echo "<div class='shadow mx-5'><h2 class='mx-4 text-danger' style='text-align:center'>No shops found for '<b>". htmlspecialchars($search)."</b>'" ." in ".$category."</h2>";
}
}     echo"
    </div>
    </body>
    </html>
    ";

     $conn->close();
?>
