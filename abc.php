<?php
include("connection.php");
 $count=0;
$search=$_GET['search'];
$category=$_GET['category'];
$Offset=12;
$Prev=12;
if($category=="All")
{
     $shop_data="SELECT * FROM tm_shopinfo where (shop_location like '%$search%' or shop_title like '%$search%') limit 12";
    $shop_result=$conn->query($shop_data);
    if($shop_result->num_rows>0){
       echo"     <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
   <style>
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
<body style='padding-bottom:50px;padding-top:30px'>
        <div class='shadow mx-5'>
       <div>
";
 $rows=$shop_result->num_rows;
        while($shop_row=$shop_result->fetch_assoc()){
            $title=$shop_row["shop_title"];
            $shop_id=$shop_row["shop_id"];
            $location=$shop_row["shop_location"];
            $imageData=$shop_row["shop_image"];
            $image= base64_encode($imageData);
            if($count%3==0)
            {
                echo "<div class='row'>";
            }
            echo"
    <div class='col-md-3 col-sm-6 mb-5 mt-5 mx-4'>
            <div class='card' id='card' >
  <img src='data:image/jpeg;base64,{$image} 'class='card-img-top' alt='shop img'>
  <div class='card-body'>
    <h5 class='card-title'>Shop Name : $title</h5>
    <p class='card-text mt-2'>📍 $location</p>
    <a href='details.php?shop=$shop_id' class='btn btn-secondary my-4'>Details</a>
    
  </div>
</div>
</div>

              
            ";
              $count++;
             if($count%3==0)
            {
                echo "</div>";
            }
        }
        if($count%3!=0)
        {
            echo"</div>";
        }
        if($count==$rows)
        {
            if($rows==12)
            {
                echo"<a href='search_mul_shops.php?search=$search&category=$category&offset=$Offset&prev=$Prev' class='btn btn-primary my-3 fs-5' style='margin-left:47%;'>Next></a>";
            }
            
            echo "</div>";
        }
    
}
}
else
{
          $shop_data="SELECT * FROM tm_shopinfo where shop_category='$category' and (shop_location like '%$search%' or shop_title like '%$search%') limit 12";
    $shop_result=$conn->query($shop_data);
    if($shop_result->num_rows>0){
       echo"     <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
   <style>
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
<body style='padding-bottom:50px;padding-top:30px'>
        <div class='shadow mx-5'>
       <div>
";
 $rows=$shop_result->num_rows;
        while($shop_row=$shop_result->fetch_assoc()){
            $title=$shop_row["shop_title"];
            $shop_id=$shop_row["shop_id"];
            $location=$shop_row["shop_location"];
            $imageData=$shop_row["shop_image"];
            $image= base64_encode($imageData);
            if($count%3==0)
            {
                echo "<div class='row'>";
            }
            echo"
    <div class='col-md-3 col-sm-6 mb-5 mt-5 mx-4'>
            <div class='card' id='card' >
  <img src='data:image/jpeg;base64,{$image} 'class='card-img-top' alt='shop img'>
  <div class='card-body'>
    <h5 class='card-title'>Shop Name : $title</h5>
    <p class='card-text mt-2'>📍 $location</p>
    <a href='details.php?shop=$shop_id' class='btn btn-secondary my-4'>Details</a>
    
  </div>
</div>
</div>

              
            ";
              $count++;
             if($count%3==0)
            {
                echo "</div>";
            }
        }
        if($count%3!=0)
        {
            echo"</div>";
        }
        if($count==$rows)
        {
            if($rows==12)
            {
                 echo"<a href='search_mul_shops.php?search=$search&category=$category&offset=$Offset&prev=$Prev' class='btn btn-primary my-3 fs-5' style='margin-left:47%;'>Next></a>";
            }
            echo "</div>";
        }
    }
}
     echo"
    </div>
    </body>
    </html>
    ";
    $conn->close();
?>
