<?php

include("connection.php");
$cat_name=$_POST["cat_name"];
$sql="SELECT category_name from shop_category where LOWER(category_name) = LOWER('$cat_name')";
    $cat_result=$conn->query($sql);
    if($cat_result->num_rows>0)
    {
        echo "duplicate";
    }





?>