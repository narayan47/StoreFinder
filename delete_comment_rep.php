<?php
include("connection.php");
$id=$_POST["feedback_id"];
$sql="DELETE FROM reply_comment where rc_id=$id";
$result=$conn->query($sql);
$conn->close();
?>