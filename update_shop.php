<?php
     session_start();
include("connection.php");

$targetDir = "uploads/shop_img/";
$imageName = null;

if (isset($_FILES["fileInput"]) && is_uploaded_file($_FILES['fileInput']['tmp_name'])) {
    // Uploaded file
    $originalName = basename($_FILES["fileInput"]["name"]);
    $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $newName = uniqid("img_", true) . "." . $fileExt;
    $targetPath = $targetDir . $newName;

    if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetPath)) {
        $imageName = $newName;
    }

} 
// Save to DB
if ($imageName !== null) {
    $weekday=$_POST["weekday"];
    $title=$_POST["shop_title"];
    $location=$_POST["location"];
    $description=$_POST["shop_des"];
    $category=$_POST["category"];
    $Opentime=$_POST["shop_opentime"];
    $Closetime=$_POST["shop_closetime"];
    $shop_id=(int)$_POST["shop_id"];
    $data=$conn->prepare("UPDATE tm_shopinfo SET shop_title=?,shop_location=?,shop_description=?,shop_image=?,shop_category=?,shop_opening_time=?,shop_closing_time=?,shop_open_days=? where shop_id=?"); 
    if(!$data)
    {
        echo "Errror".$conn->error;
    }
    $data->bind_param("ssssssssi",$title,$location,$description,$imageName, $category, $Opentime, $Closetime,$weekday,$shop_id);
    if($data->execute())
    {
        echo "recored updated";
    }
    else
    {
        echo"Error : ".$conn->error;
    }
}

 $conn->close();
?>