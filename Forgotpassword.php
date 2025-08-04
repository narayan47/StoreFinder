<?php   include("loginhead.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function(){
    $("#s_email").val('');
  })
    $(document).on("blur","#s_email",function(){
       const email = $(this).val().trim();
       const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
        $("#al_email").html("<p style='color:red;margin-left:13%'>Email is required</p>");
        $("#s_email").css("border", "1px solid red");
    } else if (!emailPattern.test(email)) {
        $("#al_email").html("<p style='color:red;margin-left:13%'>Invalid email format</p>");
        $("#s_email").css("border", "1px solid red");
    }else{
        $.ajax({
            url:'forgotpass_notexist.php',
            type:'POST',
            data:{s_email:email},
            success:function(response){
              const ab=response.trim();
                console.log(ab)
            if(ab== "not exist")
            {
                  $("#al_email").html("<p style='color:red;margin-left:13%'>Email not exist</p>");
                $("#s_email").css("border","1px solid red");
               
            }
            else
            {
              $("#al_email").html("");
                $("#s_email").css("border","1px solid green"); 
              
            }
        }
        })  
    }
     
})
 $(document).on("click","#forgot",function(e){
  const email=$('#s_email').val().trim();
  const error=$('#al_email').text().trim();
    e.preventDefault();
    if (email === "") {
        $("#al_email").html("<p style='color:red;margin-left:13%'>Email is required</p>");
        $("#s_email").css("border", "1px solid red");
    }
    else if(error =="")
    {
         $.ajax({
            url:'forgotpass.php',
            type:'POST',
            success:function(response){
               window.location.href='forgotpassword_otp.php';
}
});
    }
    })
</script>

    <style>
      
          .logo {
      font-family: 'Pacifico', cursive;
      font-size: 30px;
      color: #1e1e2f;
      letter-spacing: 0 px;
      background: linear-gradient(90deg, #ff416c, #ff4b2b);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-left: -20px;
    }
    
 
#container {
  width: 80%;
  margin-left: 10%;
}
#forgot {
  margin-left: 25%;
  padding-left:30px;
        padding-right: 30px;
}


@media (min-width: 540px) {
  #forgot {
    margin-left: 34%;
  }
}


@media (min-width: 768px) {
  #container {
    width: 80%;
  }
  #forgot {
    margin-left: 35%;
  }
}

@media (min-width: 1024px) {
  #container {
    width: 80%;
  }
  #forgot {
    margin-left: 40%;
  }
}

     
     
    </style>
</head>
<body style="padding-top: 100px;">
    <div class="shadow rounded-3" id="container">
        <div class="d-flex justify-content-center">
<img src="images.png" alt="" height="150" width="150">
</div>
  <h3 style="text-align: center;">Trouble logging in?</h3>
  <p style="text-align: center;" class="mx-2">Enter your email, phone, or username and we'll send you a link to get back into your account.</p>
       <input type="email" placeholder="email" class="form-control data w-75 my-4" name="s_email" required id="s_email" style="margin-left: 12%;">
        <span id="al_email" class="error dtext"></span>
         <button type="submit" class="btn  btn-primary mb-4" id="forgot">SEND OTP</button>
    </div>
</body>
</html>