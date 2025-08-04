<?php
include("header.php");
    $shop_id=$_GET["shop"];
    $_SESSION["shop_id"]=$shop_id;
    $feedback=include("comment.php");
    include ("connection.php");
    $shop_data="SELECT * FROM tm_shopinfo WHERE shop_id=$shop_id";
    $shop_result=$conn->query($shop_data);
    if($shop_result->num_rows>0){
        $row=$shop_result->fetch_assoc();
        $shopkeeper_id=$row["shopkeeper_id"];
        $title=$row["shop_title"];
        $location=$row["shop_location"];
        $description=$row["shop_description"];
        $image=$row["shop_image"];
        $category=$row["shop_category"];
        $Otime=$row["shop_opening_time"];
        $Ctime=$row["shop_closing_time"];
        $weekday=$row["shop_open_days"];
        $user_data="SELECT user_fullname,user_contact from tm_user where user_id=$shopkeeper_id";
        $user_result=$conn->query($user_data);
        $user_row=$user_result->fetch_assoc();
        $fullname=$user_row["user_fullname"];
        $contact=$user_row["user_contact"];
        $time=null;
        $view=(int)$row["views"];
        $count=$view+1;
        $update_view="UPDATE tm_shopinfo SET views=$count where shop_id=$shop_id";
        $update_result=$conn->query($update_view);
        if($Otime=="00:00:00" && $Ctime=="00:00:00"){
            $time="<div class='input-group p-2'>
            <i class='bi bi-clock-fill fs-5  text-success'></i>
                <p class='fs-5 mx-2'>Open 24hr</p>
                </div>";
        }
        else{
              $Otime=strtotime($Otime);
              $Ctime=strtotime($Ctime);
              $Opentime=date("h:ia", $Otime);
              $Closetime=date("h:ia",$Ctime); 
               $time=" <div class='input-group p-2'>
                    <i class='bi bi-clock-fill fs-5 text-success'>  Open Time :</i>
                     <p class='fs-5 mx-2'>$Opentime</p>
                    </div><div class='input-group p-2'>
                    <i class='bi bi-clock-fill fs-5 text-warning'>  Close Time :</i>
                     <p class='fs-5 mx-2'>$Closetime</p>
                    </div>";
        }
        echo"
            <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Details</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>

  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
  <script>
        $(document).ready(function(){  
     $(document).on('keyup', '.rp_msg', function() {
  const msg = $(this).val().trim();
  if (msg.length >= 1) {
    $('.submits').prop('disabled', false);
      $('.submit').prop('disabled', false);
  } else {
    $('.submits').prop('disabled', true); 
  $('.submit').prop('disabled', true); 
  }
});
  $(document).on('keyup', '.msg', function() {
  const msg = $(this).val().trim();
  if (msg.length >= 1) {
    $('.save').prop('disabled', false);
  } else {
    $('.save').prop('disabled', true); 
  }
});
          $.ajax({
          url:'shop_comment.php',
          type:'post',
          success:function(response)
          {
          $('#all_comment').html(response);
            $('.reply_div').hide();
             $('.reply_divs').hide();
               $('.sreply_div').hide();
               $('.reply_divss').hide();
                $('.reply_ans').hide();
                $('.submit').prop('disabled', true);
         $('.submits').prop('disabled', true);
         $('.save').prop('disabled', true);
      }
      });
$(document).on('click', '.reply_num', function (e) {
    const currentReplyAns = $(this).next('.reply_ans');
     const rnp = $(this).find('.rn');
    currentReplyAns.slideToggle();
    rnp.toggleClass('bi bi-chevron-up');
});



        

      $(document).on('click','.creply',function()
      {
          const currentReplyDiv = $(this).closest('.comment').find('.reply_div');
    if (currentReplyDiv.is(':visible')) {
        currentReplyDiv.hide();
        $('.rp_msg').val('');
    } else {
        $('.reply_div').hide(); 
       $('.sreply_div').hide(); 
        currentReplyDiv.show(); 
          $('.rp_msg').val(''); 
    }
      });
    

$(document).on('click','.ccreply',function()
      {
          const currentReplyDiv = $(this).closest('.comment').find('.sreply_div').first();
    if (currentReplyDiv.is(':visible')) {
          currentReplyDiv.hide();
          $('.msg').val(''); 
    } else {
        $('.sreply_div').hide(); 
       $('.reply_div').hide(); 
        currentReplyDiv.show();
          $('.msg').val('');  
          $('.rp_msg').val(''); 
    }
      });

      $(document).on('click','.cancel',function()
{
         $('.reply_div').hide();  
         $('.rp_msg').val('');
    });
    
      $(document).on('click','.cancels',function()
{
         $('.sreply_div').hide(); 
         $('.msg').val('');       
    });
       $(document).on('click', '.like', function() {
    const f_id = $(this).data('feedback_like_id');
    const targetLikedDiv= $(this).closest('.comment').find('.liked').first();

    $.ajax({
        url: 'like_update.php',
        type: 'post',
        data: { feedback_id: f_id },
        success: function(response) {
        console.log(response);
          if(response=='login')
          {
            window.location.href = 'registration.php'; 
          }
          else
          {
           targetLikedDiv.html(response);
}
        }
    });
});

$(document).on('click', '.delete', function() {
    const f_id = $(this).data('comment-id');
    if (!confirm('Are you sure you want to delete this comment?')) {
        return;
    }
        console.log(f_id);
    $.ajax({
        url: 'delete_comment.php',
        type: 'post',
        data: { feedback_id: f_id },
        success: function(response) {
         $.ajax({
          url:'shop_comment.php',
          type:'post',
          success:function(response)
          {
          $('#all_comment').html(response);
            $('.reply_div').hide();
             $('.sreply_div').hide();
             $('.reply_divs').hide(); 
             $('.reply_divss').hide();
             $('.reply_ans').hide();
             
      }
      });
        }
    });
});
$(document).on('click', '.rpdelete', function() {
    const f_id = $(this).data('comment-id');
    if (!confirm('Are you sure you want to delete this comment?')) {
        return;
    }
        console.log(f_id);
    $.ajax({
        url: 'delete_comment_rep.php',
        type: 'post',
        data: { feedback_id: f_id },
        success: function(response) {
         $.ajax({
          url:'shop_comment.php',
          type:'post',
          success:function(response)
          {
          $('#all_comment').html(response);
            $('.reply_div').hide();
              $('.sreply_div').hide();
             $('.reply_divs').hide(); 
             $('.reply_divss').hide();
              $('.reply_ans').hide();

      }
      });
        }
    });
});
 $(document).on('click', '.dislike', function() {
    const f_id = $(this).data('feedback_dislike_id');
    const targetLikedDiv= $(this).closest('.comment').find('.liked').first();

    $.ajax({
        url: 'like_update.php',
        type: 'post',
        data: { feedback_dislike_id: f_id },
        success: function(response) {
          if(response=='login')
          {
            window.location.href = 'registration.php'; 
          }
          else
          {
           targetLikedDiv.html(response);
}
        }
    });
});

$(document).on('click', '.edit', function() {

    const targetEditDiv = $(this).closest('.comment').find('.ed');
     const targetInputDiv = $(this).closest('.comment').find('.reply_divs');
    targetEditDiv.hide();
    targetInputDiv.show();
    $('.reply_divss').hide();
     $('.sreply_div').hide();
});
$(document).on('click', '.rpedit', function() {
    const targetEditDiv = $(this).closest('.comment').find('.eds');
     const targetInputDiv = $(this).closest('.comment').find('.reply_divss');
    targetEditDiv.hide();
    targetInputDiv.show();
     $('.sreply_div').hide();

});
$(document).on('click', '.cancels', function() {
    const targetEditDiv = $(this).closest('.comment').find('.ed');
     const targetInputDiv = $(this).closest('.comment').find('.reply_divs');
    targetEditDiv.show();
    targetInputDiv.hide();  
    $('.reply_divss').hide();
   
});

$(document).on('click', '.save', function() {
  const f_id = $(this).closest('.reply_divs').data('feedback-id');
    const comment = $(this).closest('.reply_divs').find('.msg').val();
     const targetEditDiv = $(this).closest('.comment').find('.ed');
     const targetInputDiv = $(this).closest('.comment').find('.reply_divs');
     $.ajax({
        url: 'comment_update.php',
        type: 'post',
        data: { comment:comment,cmt_id:f_id},
        success: function(response) {
         $.ajax({
          url:'shop_comment.php',
          type:'post',
          success:function(response)
          {
          $('#all_comment').html(response);
            $('.reply_div').hide();
            $('.sreply_div').hide();
             $('.reply_divs').hide();
             $('.reply_divss').hide();
              $('.reply_ans').hide();


      }
      });
       targetEditDiv.show();
    targetInputDiv.hide();

        }
    });
     
});



$(document).on('click', '.saves', function() {
  const f_id = $(this).closest('.reply_divss').data('feedback-id');
    const comment = $(this).closest('.reply_divss').find('.msg').val();
     const targetEditDiv = $(this).closest('.comment').find('.ed');
     const targetInputDiv = $(this).closest('.comment').find('.reply_divss');
     $.ajax({
        url: 'comment_update_rep.php',
        type: 'post',
        data: { comment:comment,cmt_id:f_id},
        success: function(response) {
         $.ajax({
          url:'shop_comment.php',
          type:'post',
          success:function(response)
          {
          $('#all_comment').html(response);
            $('.reply_div').hide();
            $('.sreply_div').hide();
             $('.reply_divs').hide();
             $('.reply_divss').hide();
              $('.reply_ans').hide();
               $('.reply_ans').hide();


      }
      });
       targetEditDiv.show();
    targetInputDiv.hide();

        }
    });
     
});



$(document).on('click', '.submit', function() {
  const f_id = $(this).closest('.reply_div').data('feedback_id');
    const comment = $(this).closest('.reply_div').find('.rp_msg').val();
     $.ajax({
        url: 'reply_comment.php',
        type: 'post',
        data: { comment:comment,cmt_id:f_id},
        success: function(response) {
        $.ajax({
          url:'shop_comment.php',
          type:'post',
          success:function(response)
          {
          $('#all_comment').html(response);
            $('.reply_div').hide();
             $('.sreply_div').hide();
             $('.reply_divs').hide();
             $('.reply_divss').hide();
               $('.reply_ans').hide();
                 
      }
      });
}
    });
     
});

$(document).on('click', '.submits', function() {
  const f_id = $(this).closest('.sreply_div').data('feedback_id');
    const comment = $(this).closest('.sreply_div').find('.rp_msg').val();
     $.ajax({
        url: 'reply_comment.php',
        type: 'post',
        data: { comment:comment,cmt_id:f_id},
        success: function(response) {
        $.ajax({
          url:'shop_comment.php',
          type:'post',
          success:function(response)
          {
          $('#all_comment').html(response);
            $('.reply_div').hide();
             $('.reply_divs').hide();
              $('.sreply_div').hide();
              $('.reply_divss').hide();
               $('.reply_ans').hide();
      }
      });
}
    });
     
});
      });
  

       window.addEventListener('scroll', function() {
    const scrollY = window.scrollY || document.documentElement.scrollTop;
    const viewCounter = document.getElementById('view-counter');
    viewCounter.style.top = (scrollY + 400) + 'px'; 
  });
  </script>
    <style>
    .dropdown-menu {
    z-index: 1050 !important;
}
     .submit:hover {
    background-color: blue;
}
        #title{
        text-align:center;
    }
        #img{
        background-image:url('uploads/shop_img/{$image}');
        max-height:200px;
        max-width:300px;
    }
        body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .index_container {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
    } 
      #detail{
      text-align:center;
    }
    @media (max-width: 768px) {
      .bg-box{
      width:80%;
      height:80%;
    }
       
}
    </style>
</head>
<body style='padding-top:90px;padding-bottom:10px'>
 <div style='position: relative;'>
 <div id='view-counter' style='position: absolute; top: 500px; right: 20px; z-index: 999;'>
  <span class='bg-light px-3 py-1 rounded-3 d-flex align-items-center gap-2 shadow'>
    <i class='bi bi-eye text-danger fs-4'></i>
    <span class='text-dark fw-bold fs-5'> $count</span>
  </span>
</div>
        <div class='bg bg-light shadow my-5 mx-5'><h3 id='title' class='py-3 text-warning'>$title</h3></div>
<div class='index_container'>
    <div class='bg-box shadow rounded overflow-hidden'>
  <img src='uploads/shop_img/{$image}' alt='shop_img' class='img-fluid w-100 h-100' />
</div>
  </div>
  <div  class='bg bg-light shadow my-5 p-5 mx-5'>
    <h2 class='text-warning fs-1' id='detail'> <i class='bi bi-shop-window fs-2 mx-2 text-success'></i>
Details <i class='bi bi-shop-window fs-2 mx-1 text-danger'></i></h2>
    <div class='input-group p-2'>
      <i class='bi bi-geo-alt-fill fs-5  text-danger'></i>
      <p class='fs-5 mx-1'>$location</p>
    </div>
    <div class='input-group p-1'>
    <a href='user_profile.php?u_id=$shopkeeper_id' style='text-decoration:none;' class='d-flex align-items-center gap-2'>
     <i class='bi bi-person-circle fs-5 text-success'></i>
      <p class='fs-5 mx-1'>$fullname</p>
      </a>
    </div>
          <div class='input-group p-1'>
     <i class='bi bi-phone-fill fs-5   text-primary'></i>
      <p class='fs-5 mx-1'>$contact</p>
    </div>
         <div class='input-group p-2'>
     <i class='bi bi-shop-window fs-5 text-primary'> Category :</i>
      <p class='fs-5 mx-1'>$category</p>
    </div>
          <div class='input-group p-2'>
     <i class='bi-calendar-week fs-5  text-primary'> Opening Days :</i>
      <p class='fs-5 mx-1'>$weekday</p>
    </div>
       $time
       <div class='input-group p-2'>
     <i class='bi bi-info-circle-fill fs-5 text-primary'></i>
      <p class='fs-5 mx-1'>$description</p>
    </div>
       
  </div>
   <div class='bg-light shadow my-5 mx-2 p-5 position-relative'>
  <h2 class='fs-2 text-success'>Feedback :-</h2>
  $feedback
  <div id='all_comment'>
  </div>
</div>

    </div>
</body>
</html>
        ";
    }
    else
    {
       echo"
            <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Details</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
   
    <style>
      #title{
        text-align:center;
        height:50vh;
        font-size:400%;
        padding-top:7% ;
    }
    </style>
</head>
<body style='padding-top:140px;'>
     <div class='bg bg-light shadow my-5 mx-5'><h2 id='title' class='text-warning'>OOPS ! Shop Not Availabel </h2></div>
</body>
</html>
        ";
    }

 $conn->close();
?>