
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Finder</title>
     <link rel='icon' type='image/png' href='favicons.png' >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Jquery animation , Validation -->
     <script>
setInterval(() => {
  fetch('update_activity.php');
}, 2000);
</script>
    <script>
      $(document).ready(function(){
    $("#rf").hide();
    $(".div").css({"border-radius":"20px","height":"80vh"});
$("#rg").css({
  "background-image": "url('shop_bg.png')",
  "background-size": "cover",
  "background-position": "center",
  "background-repeat": "no-repeat"
});
   $("#rg").prepend(`
  <div id='welcomeText' class='welcometext-box'>
    <h2>Welcome back! Ready to explore the best stores around you? 🔒</h2>
    <p>Login to continue your store-finding journey.</p>
    <br>
    <span>Don’t have an Account?</span><br>
    <a href='' id='op_singup' class='btn btn-danger'>Sign UP</a>
  </div>
`);
    $("#op_singup").click(function(e){
        e.preventDefault(); // prevent link default action
        $("#lf").animate({
            marginLeft: "-20px",
            opacity: 0
        }, 1000, function() {
            $("#lf").hide();
               if (window.innerWidth <= 576) {
  $(".div").css({
    "border-radius": "20px",
    "height": "90vh"
  });
}else
{$(".div").css({"border-radius":"20px","height":"120vh"});}
             $(".data").val("");
             $(".dtext").text("");
              $(".data").css("border","");
            $("#rf").fadeIn(0);
             $("#rg").css("background-image", "none");
             $("#welcomeText").remove();
           $("#lg").css({
  "background-image": "url('shop_bg.png')",
  "background-size": "cover",
  "background-position": "center",
  "background-repeat": "no-repeat",
});  
 $("#lg").prepend(`
<div id='welcomeText' class='welcome-box'>
  <h2>Welcome to StoreFinder 👋<br>Find the right store, right around the corner!</h2>
  <p>Sign up now to explore top-rated local shops and leave your own reviews.</p>
  <br>
  <span>Already have an Account?</span><br>
  <a href='' id='op_login' class='btn btn-danger'>Login</a>
</div>
`);

        });
    });
});
$(document).on("click", "#op_login", function (e) {
        e.preventDefault();
        $("#rf").animate({
            marginRight:"20px",
            opacity:0
        },1000,function(){
              $("#rf").fadeOut(0, function () {
                $(".div").css({"border-radius":"20px","height":"80vh"});
          $("#lf").show().css({ marginLeft: "0", opacity: 1 });
          $("#lg").css("background-image", "none");
          $("#welcomeText").remove();
           $(".data").val("");
             $(".dtext").text("");
              $(".data").css("border","");

          $("#rg").css({
            "background-image": "url('shop_bg.png')",
            "background-size": "cover",
            "background-position": "center",
            "background-repeat": "no-repeat"
          });

         $("#rg").prepend(`
  <div id='welcomeText' class='welcometext-box'>
    <h2>Welcome back! Ready to explore the best stores around you? 🔒</h2>
    <p>Login to continue your store-finding journey.</p>
    <br>
    <span>Don’t have an Account?</span><br>
    <a href='' id='op_singup' class='btn btn-danger'>Sign UP</a>
  </div>
`);        
 $("#op_singup").click(function(e){
        e.preventDefault(); // prevent link default action
        $("#lf").animate({
            marginLeft: "-20px",
            opacity: 0
        }, 1000, function() {
            $("#lf").hide();
            if (window.innerWidth <= 576) {
  $(".div").css({
    "border-radius": "20px",
    "height": "90vh"
  });
}
else
{
      $(".div").css({"border-radius":"20px","height":"120vh"});
}
            $(".data").val("");
             $(".dtext").text("");
              $(".data").css("border","");
            $("#rf").fadeIn(0);
             $("#rf").animate({
            marginLeft: "5px",
            opacity: 1
        }, 1000, function() {})
             $("#rg").css("background-image", "none");
             $("#welcomeText").remove();
           $("#lg").css({
  "background-image": "url('shop_bg.png')",
  "background-size": "cover",
  "background-position": "center",
  "background-repeat": "no-repeat",
});  
  $("#lg").prepend(`
<div id='welcomeText' class='welcome-box'>
  <h2>Welcome to StoreFinder 👋<br>Find the right store, right around the corner!</h2>
  <p>Sign up now to explore top-rated local shops and leave your own reviews.</p>
  <br>
  <span>Already have an Account?</span><br>
  <a href='' id='op_login' class='btn btn-danger'>Login</a>
</div>
`);

        });
    });
        })
        });
      });
             $(document).on("blur", "#s_fname", function (e) {
    const first_name = $(this).val().trim();
    if (!/^[a-zA-Z]+$/.test(first_name)) {
        $("#fname_error").html("<p style='color:red'>Only letters allowed in First Name (A-Za-z)</p>");
        $("#s_fname").css("border","1px solid red")
    } else {
        $("#fname_error").text("");
        $("#s_fname").css("border","")
    }
});
     $(document).on("blur", "#s_lname", function (e) {
    const last_name = $(this).val().trim();
    if (!/^[a-zA-Z]+$/.test(last_name)) {
        $("#lname_error").html("<p style='color:red'>Only letters allowed in Last Name (A-Za-z)</p>");
        $("#s_lname").css("border","1px solid red")
    } else {
        $("#lname_error").text("");
        $("#s_lname").css("border","")
    
    }
});
$(document).on("blur", "#s_password", function(e){
    const password= $(this).val();
    if (/[\s]/.test(password)) {
        $("#ss_password").html("<p style='color:red'>Space or tab not allowed</p>");
        $("#s_password").css("border","1px solid red");
    } else if(password.length<6)
    {
         $("#ss_password").html("<p style='color:red'>🔐 Please enter a password longer than 5 characters to keep your account secure.</p>");
        $("#s_password").css("border","1px solid red");
    }
    else if(password.length>25)
    {
        $("#ss_password").html("<p style='color:red'>🔐 Password should not exceed 25 characters.</p>");
        $("#s_password").css("border","1px solid red");
    }
    else{
        $("#ss_password").text("");
        $("#s_password").css("border","");
    }
     const retype_password=$("#retype_password").val();
    if (password != retype_password) {
        $("#password_error").html("<p style='color:red'>Retype Password must same as Password</p>");
        $("#retype_password").css("border","1px solid red");
        return;
    } else {
        $("#password_error").text("");
        $("#retype_password").css("border","")
    }
    });
     $(document).on("blur", "#retype_password", function () {
    const password = $("#s_password").val().trim();
    const retype_password=$(this).val().trim();
    if (password != retype_password) {
        $("#password_error").html("<p style='color:red'>Retype Password must same as Password</p>");
        $("#retype_password").css("border","1px solid red")
    } else {
        $("#password_error").text("");
        $("#retype_password").css("border","")
    }
});

$(document).on("blur","#s_email",function(){
     $.ajax({
            url:'exist_user.php',
            type:'POST',
            data: $("#rf").serialize(),
            success:function(response){
            let str = response.trim();
            let word = "email";
            let index = str.indexOf(word); 
            let email="";  
            if (index !== -1) {
                email= str.substring(index, index + word.length)
            }
            if(email === "email")
            {
                $("#al_email").html("<p style='color:red'>Email already exist</p>");
                $("#s_email").css("border","1px solid red");
            }
            else
            {
                $("#al_email").html("");
                $("#s_email").css("border",""); 
            }
            }
        })
})
 $(document).on("blur", "#s_phone", function (e) {
    const phone_number = $(this).val().trim();
   if (!/^[6-9][0-9]{9}$/.test(phone_number)) {
        $("#phone").html("<p style='color:red'>Invalid Phone number</p>");
        $("#s_phone").css("border","1px solid red")
        return;
    } else { 
            if(phone_number.length!=10)
    {
       e.preventDefault();
         $("#phone").html("<p style='color:red'>Phone number must contain exactly 10 digits</p>");
         $("#s_phone").css("border","1px solid red");
         return;
    }
    else
    {
         $("#phone").html("");
         $("#s_phone").css("border","");
    }
    }
    $.ajax({
            url:'exist_user.php',
            type:'POST',
            data: $("#rf").serialize(),
            success:function(response){
            let str = response.trim();
            let word = "contact";
            let index = str.indexOf(word);   
            let contact="";
            if (index !== -1) {
                contact = str.substring(index, index + word.length)
            }
            if(contact === "contact")
            {
               e.preventDefault();
                $("#phone").html("<p style='color:red'>Contact already exist</p>");
                $("#s_phone").css("border","1px solid red");
            }
            else
            {
                $("#phone").html("");
                $("#s_phone").css("border",""); 
            }
            }
        })
    
});
    $(document).on("click","#signup",function(e){
      const phone_number = $("#s_phone").val().trim();
      e.preventDefault();
        const form = document.getElementById("rf");
         if (!form.checkValidity()) {
            form.reportValidity();
            return;
    }
    if(phone_number.length!=10)
    {
       e.preventDefault();
         $("#phone").html("<p style='color:red'>Phone number must contain exactly 10 digits</p>");
         $("#s_phone").css("border","1px solid red");
         return;
    }
         if($(".error").text()!="")
         {
            e.preventDefault();
            $("#error").html("<p style='text-align:center;color:red'>Please Enter valid Data</p>")
             window.scrollTo({
                top: 0,
                behavior: "smooth"
                });
         }
         else
         {
            $("#error").html("")
             $.ajax({
            url:'signup.php',
            type:'POST',
            data: $("#rf").serialize(),
            success:function(response){
              window.location.href = "index.php"; 
            }
        })
         }
    })
      

     $(document).on("click","#login",function(e){
         const form = document.getElementById("lf");
         if (!form.checkValidity()) {
            form.reportValidity();
            return;
    }
     e.preventDefault();
        console.log("rff");
        $.ajax({
            url:'login.php',
            type:'POST',
            data: $("#lf").serialize(),
            success:function(response){
            if(response.trim() === "password not  exist")
            {

                $("#l_email_contact").html("");
                $("#l_email").css("border","");
                $("#password").html("<p style='color:red'>Invalid password</p>");
                $("#l_password").css("border","1px solid red");
            }
            else if(response.trim() === "not exist")
            {

                $("#l_email_contact").html("<p style='color:red;text-align:center'>Invalid User</p>");
                $("#l_password").css("border","1px solid red");
                $("#l_email").css("border","1px solid red");
                 $("#password").html("");
            }
            else if(response.trim() === "exist")
            {
                $("#password").html("");
                $("#l_email_contact").html("");
                $("#l_email").css("border","");
                $("#l_password").css("border","");
                window.location.href = "index.php"; 
            }
            else
            {   
                    console.log(response)
            }
            }
        })

    })
    </script>
<!-- CSS -->
    <style>
       #forgot{
    margin-left: 30%;
  }
        body{
            background-image:url("https://media.istockphoto.com/id/1016559668/photo/glitter-lights-abstract-background-silver-and-white-defocused.webp?a=1&b=1&s=612x612&w=0&k=20&c=K_GQODbWu9KFPAJjxpX4UWyhMBtHEYfMS7pMoQRkn30=");
            background-size:cover;
            padding-top: 40px;

        }
        #container{
            margin-left:20%;
            margin-right: 15%;
            margin-top:9%;
            border-radius:20px;
            background-color: white;
            height: 70vh;
        }
        #rg{
            background-color: white;
            padding-top:20px;
            padding-bottom: 20px;
        }
        #lg{
             background-color: white;
            padding-top:20px;
            padding-bottom: 20px;
        }
        input,label,select,span,a{
            margin-top:30px;
        }
        button{
            margin-left:30%;
            margin-top: 30px;
            width: 20vh;
            margin-bottom:20px;
        }
        a{
            text-decoration: none;
        }
        h2{
            text-align: center;
        }

                .welcometext-box {
  text-align: center;
  padding: 20px;
  color: #FFFFFF;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
}

.welcometext-box h2 {
  font-size: 35px;
  font-weight: bold;
  color: #FFFFFF;
  text-shadow: 2px 2px 8px #000;
}

.welcometext-box p {
  font-size: 25px;
  color: #f0f0f0;
  text-shadow: 1px 1px 4px #000;
}
#user{
  height: 80px;
  width: 80px;
}
.welcometext-box span {
  font-size: 20px;
  color: #f0f0f0;
  text-shadow: 1px 1px 4px #000;
}

.welcometext-box a.btn-danger {
  margin-top: 10px;
  font-size: 18px;
  padding: 8px 20px;
  border-radius: 10px;
}
        .welcome-box {
  text-align: center;
  padding: 30px;
  color: #fff;
  text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.9);
}

.welcome-box h2 {
  font-size: 35px;
  font-weight: bold;
  text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
  padding-top: 30px;
}
.welcome-box p,
.welcome-box span,
.welcome-box a {
  font-size: 20px;
  color: #ddd;
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
}

.welcome-box a {
  margin-top: 12px;
  padding: 8px 20px;
  border-radius: 10px;
  font-size: 18px;
  
}
@media(max-width:1024px),(max-width: 768px){
    .welcome-box {
    padding: 20px;
  }

  .welcome-box h2 {
    font-size: 27px;
  }

  .welcome-box p,
  .welcome-box span,
  .welcome-box a {
    font-size: 20px;
    color:whitesmoke;
  }
  #container {
    margin: 2%;
    height: 70vh;
    margin-top:10%;
  }
       
  button {
    margin-left: 0;
    width: 100%;
  }
  .welcometext-box h2 {
    font-size: 27px;
  }

  .welcometext-box p,
  .welcometext-box span,
  .welcometext-box a.btn-danger {
    font-size: 20px;
    color:whitesmoke;
  }

  .welcometext-box {
    padding: 20px;
  }

}
@media (max-width: 576px),(max-width: 768px) {
  .welcome-box {
    padding: 15px;
  }

  .welcome-box h2 {
    font-size: 25px;
  }

  .welcome-box p,
  .welcome-box span,
  .welcome-box a {
    font-size: 19px;
    color:whitesmoke;
  }
  #container {
    margin: 2%;
    height: 70vh;
    margin-top:20%;
  }
       
  button {
    margin-left: 0;
    width: 100%;
  }
  .welcometext-box h2 {
    font-size: 26px;
  }

  .welcometext-box p,
  .welcometext-box span,
  .welcometext-box a.btn-danger {
    font-size: 19px;
    color:whitesmoke;
  }

  .welcometext-box {
    padding: 16px;
  }
}

@media (max-width: 430px){
  #forgot{
    margin-left: 10%;
  }
  .welcome-box {
    padding: 15px;
  }
#user{
  height: 40px;
  width: 40px;
}
#us{
  font-size: 20px;
}
  .welcome-box h2 {
    font-size: 17px;
  }

  .welcome-box p,
  .welcome-box span,
  .welcome-box a {
    font-size: 17px;
    color:whitesmoke;
  }
  #container {
    margin: 2%;
    height: 90vh;
    margin-top:20%;
  }
       
  button {
    margin-left: 0;
    width: 100%;
  }
  .welcometext-box h2 {
    font-size: 16px;
  }

  .welcometext-box p,
  .welcometext-box span,
  .welcometext-box a.btn-danger {
    font-size: 12px;
    color:whitesmoke;
  }

  .welcometext-box {
    padding: 12px;
  }
  #email_error{
    font-size: 12px;
  }
}


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

 nav{
            background-color:white;
        }
          #home{
          text-decoration:none;
          font-size:30px;
          color:black;} 
   #home:hover{
 background-color:yellow;
  color:red;
}
    </style>
</head>
<body>
  <?php  include("loginhead.php") ?>
   <div id="container" class="row">
    <!-- Login -->
            <div id="lg" class="col-md-6 col-6 div">    
                <form action="" id="lf">
                     <h2><img src="data:image/png;base64,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" height="60" ></img>Login</h2>
                     <span class="error dtext" id="l_email_contact"></span>
                    <input type="text" placeholder="email/contact" class="form-control data" name="emailorcontact" required id="l_email">
                    <input type="password" placeholder="Password" class="form-control data" name="password" required id="l_password">
                    <span class="error dtext" id="password"></span>
                    <button type="submit" class="btn btn-success" id="login">Login</button><br>
                    <div class="mt-4"><a href="Forgotpassword.php" id="forgot">Forgot password?</a></div>
                </form>
    </div>
        <!-- Sign Up -->
            <div id="rg" class="col-md-6 col-6 div">
                    <form action="index.php" method="post" id="rf">
                        <h2 id="us"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiuaNLChfhGJgcaJ9outna1kfQ-oHbANj3wg&s" alt="new user" id="user"> Sign Up</h2>
                        <span id="email_error" >Note : Please enter a registered email address</span>
                        <span id="error dtext"></span>
                        <input type="text" placeholder="First name" class="form-control data" name="fname" required id="s_fname">
                        <span id="fname_error" class="error dtext"></span>
                        <input type="text" placeholder="Last name" class="form-control data" name="lname" required id="s_lname">
                        <span id="lname_error" class="error dtext"></span>
                        <input type="email" placeholder="email" class="form-control data" name="s_email" required id="s_email">
                        <span id="al_email" class="error dtext"></span>
                        <input type="password" placeholder="password" class="form-control data" name="s_password" required id="s_password">
                        <span id="ss_password" class="error dtext"></span>
                        <input type="password" placeholder="retype password" class="form-control data" name="retype_password" required id="retype_password">
                        <span id="password_error" class="error dtext"></span>
                        <input type="text" placeholder="Phone Number" class="form-control data" name="s_phone" required id="s_phone">
                        <span id="phone" class="error dtext"></span>
                        <button type="submit" class="btn btn btn-primary" id="signup">Sign Up</button>
                    </form>
            </div>
   </div>
</body>
</html>
