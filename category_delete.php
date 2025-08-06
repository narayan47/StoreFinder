<?php
include("connection.php"); // code to include database connection file

if(isset($_GET["id"]))
{
    echo $cat_id = $_GET["id"];
	//die(0);
     $sql="SELECT category_name from shop_category where category_id=$cat_id";
    $cat_result=$conn->query($sql);
    if($cat_result->num_rows>0)
    {
        $cat_row = $cat_result->fetch_assoc();
        $category=$cat_row["category_name"];
        $sp_data="SELECT shop_id from tm_shopinfo where shop_category='$category'";
        $sp_result=$conn->query($sp_data);
        if($sp_result->num_rows>0)
        {
            while($row=$sp_result->fetch_assoc())
            {
                $shop_id=$row["shop_id"];
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
   
            }
        }
        
        $shop_delete="DELETE from tm_shopinfo where shop_category='$category'";
         $dl_res=mysqli_query($conn,$shop_delete);
        if(!$dl_res)
        {
                echo "problem in shop delete ";
        }

    }
        }
	 //code to perform delete operation start
		 echo $qry="DELETE from shop_category where category_id=$cat_id";
        //die(0);
        $category=0;
        $res=mysqli_query($conn,$qry);
        if(!$res)
        {
                echo "problem in delete ";
        }
        else{
            
            header("location:category.php");
        }
      
    ?>