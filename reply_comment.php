<?php
    session_start();
    $id=(int)$_SESSION["id"];
    $msg=$_POST["comment"];
    $f_id=(int)$_POST["cmt_id"];
    include("connection.php");
    date_default_timezone_set('Asia/Kolkata');
     $datetime=date("d-m-Y h:i:sa");
    $data=$conn->prepare("INSERT into reply_comment(user_id,feedback_id,comment_text,rfd_datetime)values(?,?,?,?);");
    $data->bind_param("iiss",$id,$f_id,$msg,$datetime);
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