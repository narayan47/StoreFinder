<?php
    session_start();
    $id=(int)$_SESSION["id"];
    $shop_id=(int)$_SESSION["shop_id"];
    $msg=$_POST["comment"];
    include("connection.php");
    date_default_timezone_set('Asia/Kolkata');
     $datetime=date("d-m-Y h:i:sa");
    $data=$conn->prepare("INSERT into tm_feedback(user_id,shop_id,feedback_msg,fd_datetime)values(?,?,?,?);");
    $data->bind_param("iiss",$id,$shop_id,$msg,$datetime);
    if($data->execute())
    {
        echo"success";
    }
    else
    {
        echo $conn->error;
    }
$conn->close();
?>