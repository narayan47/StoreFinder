<?php
session_start();
include("connection.php");
if (isset($_FILES["fileInput"]) && $_FILES["fileInput"]["error"] == 0) {
    $targetDir = "uploads/shop_img/";
    $originalName = basename($_FILES["fileInput"]["name"]);
    $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $newName = uniqid("img_", true) . "." . $fileExt;
    $targetPath = $targetDir . $newName;

    if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetPath)) {
        $weekday = $_POST["weekday"];
        $title = $_POST["shop_title"];
        $location = $_POST["location"];
        $description = $_POST["shop_des"];
        $category = $_POST["category"];
        $Opentime = $_POST["shop_opentime"];
        $Closetime = $_POST["shop_closetime"];
        $id = (int)$_SESSION["id"];

        $data = $conn->prepare("INSERT INTO tm_shopinfo(shopkeeper_id,shop_title, shop_location, shop_description, shop_image, shop_category, shop_opening_time, shop_closing_time, shop_open_days) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $data->bind_param("issssssss", $id, $title, $location, $description, $newName, $category, $Opentime, $Closetime, $weekday);

        if ($data->execute()) {
            $update = "UPDATE tm_user SET user_role='Shopkeeper' WHERE user_id = $id";
            $conn->query($update);
            echo "Upload successful!";
        } else {
            echo "Database error: " . $data->error;
        }
    } else {
        echo "Failed to move uploaded file.";
    }
} else {
    echo "No file uploaded or error occurred.";
}
 $conn->close();
?>
