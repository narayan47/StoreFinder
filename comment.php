<?php
if(!isset($_SESSION["id"]))
{
    $button="<a href='registration.php' class='btn btn-primary'>Submit</a>";
}
else
{
    $button="<button type='submit' class='btn btn-primary' id='submit'>Submit</button>";
}
return "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
       <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
    <script>
        $(document).on('click','#submit',function(e){
            const comment=$('#Textarea').val().trim();
            if(comment.length<1)
            {
                e.preventDefault();
                $('#Textarea').attr('placeholder','please First enter a comment then submit'); 
                $('#Textarea').css('border','1px solid red');
            }
            else
            {
                 $('#Textarea').attr('placeholder','please leav your comment here');
                  $('#Textarea').css('color','');
                $('#Textarea').css('border','');
                $.ajax({
                    url:'comment_backend.php',
                    type:'post',
                    data:{comment:comment},
                    success:function(response){
                        console.log(response); 
                           $('#Textarea').val('');
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

                })
            }
        })
    </script>
    <style>
      .submit:hover {
    background-color: blue;
}
 .submits:hover{
    background-color:blue;
}
    .rms{
  margin-left:59%;
}
     @media (max-width: 1024px) {
    .rms{
  margin-left:54%;
}
    }
  @media (max-width: 768px) {
    .rms{
  margin-left:45%;
}
    }
 @media (max-width: 430px) {
    .rms{
  margin-left:-5%;
  
}
   
 
    }
    </style>
</head>
<body>
    <div class='text-white p-3'>
      <textarea class='form-control' id='Textarea' name='comment' placeholder='Leave a comment here'></textarea>
    <div class='text-end mt-2'>
      $button
    </div>
  </div>
</body>
</html>";
?>