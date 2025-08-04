<?php
    session_start();
    $comment_id=(int)$_POST["cmt_id"];
    $msg=$_POST["comment"];
    include("connection.php");
     date_default_timezone_set('Asia/Kolkata');
     $datetime=date("d-m-Y h:i:sa");
    $data="UPDATE tm_feedback SET feedback_msg='$msg',fd_datetime='$datetime' where feedback_id=$comment_id";
    if($conn->query($data))
    {
        echo"success";
    }
    else
    {
        echo $conn->error;
    }
$conn->close();
?>