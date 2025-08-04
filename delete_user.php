<?php
    session_start();
    $id=(int)$_SESSION["id"];
    include("connection.php");
     $shop_ld="SELECT like_dislike_id from tm_like_dislike where user_id=$id";
    $shop_ld_result=$conn->query($shop_ld);
       if($shop_ld_result->num_rows>0){
      $shop="DELETE FROM tm_like_dislike where user_id=$id";
      $shop_d=$conn->query($shop);
    }
     $shop_rcomment="SELECT rc_id from reply_comment where user_id=$id";
    $shop_rcomment_result=$conn->query($shop_rcomment);
       if($shop_rcomment_result->num_rows>0){
      $shop="DELETE FROM reply_comment where user_id=$id";
      $shop_d=$conn->query($shop);
    }
     $shop_comment="SELECT * from tm_feedback where user_id=$id";
    $shop_comment_result=$conn->query($shop_comment);
       if($shop_comment_result->num_rows>0){
      $shop="DELETE FROM tm_feedback where user_id=$id";
      $shop_d=$conn->query($shop);
    }
   
 $shop_data="SELECT * from tm_shopinfo where shopkeeper_id=$id";
    $shop_result=$conn->query($shop_data);
    if($shop_result->num_rows>0){
      $shop="DELETE FROM tm_shopinfo where shopkeeper_id=$id";
      $shop_d=$conn->query($shop);
    }
     $user_data="DELETE FROM tm_user Where user_id=$id";
    $user_result=$conn->query($user_data);
     $conn->close();
?>