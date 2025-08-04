<?php
     session_start();
     $id = $_SESSION["id"];
include("connection.php");

$targetDir = "uploads/profile/";
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
    
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $fullname=$fname." ".$lname;    
    $email=$_POST["email"];
    $contact=(string)$_POST["contact"];
    $data=$conn->prepare("UPDATE tm_user SET user_fname=?,user_lname=?,user_fullname=?,user_email=?,user_contact=?,profile_img=? where user_id=?"); 
    if(!$data)
    {
        echo "Errror".$conn->error;
    }
    $data->bind_param("ssssssi",$fname,$lname,$fullname,$email, $contact,$imageName,$id);
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