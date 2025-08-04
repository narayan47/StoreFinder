<?php
        $shop_id=$_GET['shop'];
        include_once("connection.php");
         $shop_comment="SELECT feedback_id from tm_feedback where shop_id=$shop_id";
    $shop_comment_result=$conn->query($shop_comment);
       if($shop_comment_result->num_rows>0){
        while($row=$shop_comment_result->fetch_assoc()){
         $feedback_id=$row["feedback_id"];
      $shop="DELETE FROM tm_feedback where shop_id=$shop_id";
      $shop_d=$conn->query($shop);
  $shop_rcomment="SELECT rc_id from reply_comment where feedback_id=$feedback_id";
    $shop_rcomment_result=$conn->query($shop_rcomment);
       if($shop_rcomment_result->num_rows>0){
         while($row=$shop_rcomment_result->fetch_assoc()){
         $rpfeedback_id=$row["rc_id"];
      $shop="DELETE FROM reply_comment where feedback_id=$feedback_id";
      $shop_d=$conn->query($shop);
      $shop_rcomment="SELECT rc_id from reply_comment where feedback_id=$rpfeedback_id";
    $shop_rcomment_result=$conn->query($shop_rcomment);
       if($shop_rcomment_result->num_rows>0){
         while($row=$shop_rcomment_result->fetch_assoc()){
         $rrpfeedback_id=$row["rc_id"];
      $shop="DELETE FROM reply_comment where feedback_id=$rpfeedback_id";
      $shop_d=$conn->query($shop);
      $shop_rcomment="SELECT rc_id from reply_comment where feedback_id=$rrpfeedback_id";
    $shop_rcomment_result=$conn->query($shop_rcomment);
       if($shop_rcomment_result->num_rows>0){
      $shop="DELETE FROM reply_comment where feedback_id=$rrpfeedback_id";
      $shop_d=$conn->query($shop);
       }
 $shop_ld="SELECT like_dislike_id from tm_like_dislike where comment_id=$rrpfeedback_id";
    $shop_ld_result=$conn->query($shop_ld);
       if($shop_ld_result->num_rows>0){
      $shop="DELETE FROM tm_like_dislike where comment_id=$rrpfeedback_id";
      $shop_d=$conn->query($shop);
       }
         }
    }
     $shop_ld="SELECT like_dislike_id from tm_like_dislike where comment_id=$rpfeedback_id";
    $shop_ld_result=$conn->query($shop_ld);
       if($shop_ld_result->num_rows>0){
      $shop="DELETE FROM tm_like_dislike where comment_id=$rpfeedback_id";
      $shop_d=$conn->query($shop);
    }
         }
    }
     $shop_ld="SELECT like_dislike_id from tm_like_dislike where comment_id=$feedback_id";
    $shop_ld_result=$conn->query($shop_ld);
       if($shop_ld_result->num_rows>0){
      $shop="DELETE FROM tm_like_dislike where comment_id=$feedback_id";
      $shop_d=$conn->query($shop);
    }
        }
    }
   
     $delete="DELETE FROM tm_shopinfo Where shop_id=$shop_id";
        $delete_result=$conn->query($delete);
   
    
          header("Location:user_desbord.php");
          $conn->close();
          exit; 
?>