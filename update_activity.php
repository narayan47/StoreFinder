<?php
session_start();
include "connection.php"; 
$session_id = session_id();
$user_id = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
$ip = $_SERVER['REMOTE_ADDR'];
$now = date("Y-m-d H:i:s");

$sql = "REPLACE INTO live_user (live_user_id,user_id, ip_address, last_activity)
        VALUES (?,?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $session_id,$user_id, $ip, $now);
$stmt->execute();


$inactive_limit = date("Y-m-d H:i:s", strtotime("-1 minute"));
$delete_sql = "DELETE FROM live_user WHERE last_activity < ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("s", $inactive_limit);
$delete_stmt->execute();
?>  
