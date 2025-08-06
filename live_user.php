<?php
include("connection.php");
$data = "SELECT live_user_id FROM live_user";
$result = $conn->query($data);


if ($result && $result->num_rows > 0) {
    $live = $result->num_rows; 
    echo $live;
} else {
    echo "0";
}
?>