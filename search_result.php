<?php

include("connection.php");
$search=$_POST['search'];
$category=$_POST['category']; 
if($category=="All")  
{
$shop_data="SELECT shop_title,shop_id FROM tm_shopinfo where (shop_location like '%$search%' or shop_title like '%$search%');";
$shop_result=$conn->query($shop_data);
if($shop_result->num_rows > 0)
{
     while($shop_row=$shop_result->fetch_assoc()){
        $result=$shop_row["shop_title"];
        $shop_id=$shop_row["shop_id"];
        echo "
      <ul class='list-group'>
 <a href='details.php?shop=$shop_id' style='text-decoration: none;'><li class='list-group-item' id='li'>$result</li></a>
</ul>
        ";
     }
}
else
    echo"<h6 class='text-danger'>Sorry,That type of Store not availabel</h6>";
}else
{
    $shop_data="SELECT shop_title,shop_id FROM tm_shopinfo where shop_category='$category' and( shop_location like '%$search%' or shop_title like '%$search%');";
$shop_result=$conn->query($shop_data);
if($shop_result->num_rows > 0)
{
     while($shop_row=$shop_result->fetch_assoc()){
        $result=$shop_row["shop_title"];
        $shop_id=$shop_row["shop_id"];
        echo "
      <ul class='list-group'>
 <a href='details.php?shop=$shop_id' style='text-decoration: none;'><li class='list-group-item' id='li'>$result</li></a>
</ul>
        ";
     }
}
else
    echo"<h5 class='text-danger'>Sorry,That type of Store not availabel</h5>";
}

 $conn->close();
?>