<?php  include("loginhead.php")    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Finder</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q' crossorigin='anonymous'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script>
       $(document).on('keydown','#retype_password',function(){
        $(this).val($(this).val().replace(/\s/g, ''));
           $("#re_pass").html("");   
       });
        $(document).on('keydown','#password',function(){
        $(this).val($(this).val().replace(/\s/g, ''));
           $("#al_email").html("");   
       });

      $(document).on('blur','#retype_password',function(){
          const repass = $(this).val().trim();
          const pass = $('#password').val().trim();
            if(repass=="")
            {
               $("#re_pass").html("<p style='color:red;margin-left: 25%;'>password is must not empty</p>");
            }else{
          if(pass==repass)
          {
              $("#re_pass").html("");
          }
          else
          {
            $("#re_pass").html("<p style='color:red;margin-left: 25%;'>Retype password not match</p>");
          }
}
      });


        $(document).on('blur','#password',function(){
            const pass = $(this).val().trim();
            if(pass=="")
            {
               $("#al_email").html("<p style='color:red;margin-left: 25%;'>password is must not empty</p>");
            }
            else
            {
              $.ajax({
            url:'password_back.php',
            type:'POST',
            data:{pass:pass},
            success:function(response){
              const ab=response.trim();
            if(ab=="exist")
            {
                 $("#al_email").html("<p style='color:red;margin-left: 25%;'>New password is must have diffrent from old password</p>");
            }
            else
            {
              $("#al_email").html("");
            }
          }
            })
             }
        })

      $(document).on('click', '#retogglePassword', function () {
  const input = $('#retype_password');
  const icon = $(this);

  if (input.attr('type') === 'password') {
    input.attr('type', 'text');
    icon.removeClass('bi-eye-slash').addClass('bi-eye');
  } else {
    input.attr('type', 'password');
    icon.removeClass('bi-eye').addClass('bi-eye-slash');
  }
});

        $(document).on('click', '#togglePassword', function () {
  const input = $('#password');
  const icon = $(this);

  if (input.attr('type') === 'password') {
    input.attr('type', 'text');
    icon.removeClass('bi-eye-slash').addClass('bi-eye');
  } else {
    input.attr('type', 'password');
    icon.removeClass('bi-eye').addClass('bi-eye-slash');
  }
});


   $(document).on('click', '#verify', function (e) {
     e.preventDefault(); 
     const pass = $("#password").val().trim();
      const repass = $("#retype_password").val().trim();
      const error =$(".error").val().trim();
    if(pass=="" | repass=="")
    {
       $("#al_error").html("<p style='color:red;margin-left: 40%;'>please enter password </p>");
    }
    else if(error=="")
    {
        $.ajax({
            url:'new_password.php',
            type:'POST',
            data:{pass:pass},
            success:function(response){
              window.location.href='registration.php';
            }
            })
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
#verify {
  margin-left: 30%;
  padding-left:30px;
        padding-right: 30px;
}


@media (min-width: 540px) {
  #verify {
    margin-left: 34%;
  }
}


@media (min-width: 768px) {
  #container {
    width: 80%;
  }
  #verify {
    margin-left: 35%;
  }
}

@media (min-width: 1024px) {
  #container {
    width: 80%;
  }
  #verify {
    margin-left: 43%;
  }
}

     
    </style>
</head>
<body style='padding-top: 100px;'>
    <div class='shadow rounded-3 py-5' id='container'>
    <div class='d-flex justify-content-center'>
<img src='download.jpeg' alt='' height='150' width='150'>
</div>
<span id="al_error" class="error dtext" ></span>
<div class='d-flex justify-content-center my-3'>
<h6>Reset your password of Store Finder Account
</h6>
</div>
 <div class='d-flex justify-content-center my-3'>
    <div class="input-group mx-4 w-50">
  <input type="password" id="password" class="form-control"  placeholder="Enter password">
  <span class="input-group-text">
    <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
  </span>
</div>
</div>
<span id="al_email" class="error dtext" ></span>
 <div class='d-flex justify-content-center my-3'>
    <div class="input-group mx-4 w-50">
  <input type="password" id="retype_password" class="form-control" placeholder="Re-Type password">
  <span class="input-group-text">
    <i class="bi bi-eye-slash" id="retogglePassword" style="cursor: pointer;"></i>
  </span>
</div>
</div>
<span id="re_pass" class="error" ></span>

         <button type='submit' class='btn  btn-primary my-4' id='verify'>Submit</button>
         <div class='d-flex justify-content-center my-3'>
    </div>
  
</body>
</html>