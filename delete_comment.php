<?php
include("connection.php");
$id=$_POST["feedback_id"];
$sql="DELETE FROM tm_feedback where feedback_id=$id";
$result=$conn->query($sql);
$sql="DELETE FROM reply_comment where feedback_id=$id";
$result=$conn->query($sql);
$sql_data="SELECT rc_id from reply_comment where feedback_id=$id";
$results=$conn->query($sql_data);
if($results->num_rows > 0){
    while($row=$results->fetch_assoc()){
        $id=$row["rc_id"];
        $sql="DELETE FROM reply_comment where feedback_id=$id";
        $result=$conn->query($sql);
    }
}
$conn->close();
?>