<?php
   session_start();
    if(!isset($_SESSION["id"]))
      {
          header("location:registration.php");
          exit;
      }
    include("loginhead.php");
    include("connection.php");
    $id=(int)$_SESSION["id"];
    $user_data="SELECT user_fname,user_lname,user_email,user_contact,profile_img FROM tm_user where user_id=$id";
    $user_result=$conn->query($user_data);
     if($user_result->num_rows>0){
        $user_row=$user_result->fetch_assoc();
         $fname=$user_row["user_fname"];
            $lname=$user_row["user_lname"];
            $email=$user_row["user_email"];
            $contact=$user_row["user_contact"];
            $image=$user_row["profile_img"];
             $src_img="uploads/profile/{$image}";
            echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q' crossorigin='anonymous'></script>
     <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
     <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
    <script>
        $(document).on('blur','#input_title',function(){
            const title=$(this).val().trim();
       if(title.length<2)
        {
            $('#title').html(`<p style=\\'color:red\\'>Your First name must be Greater then 3 character`);
            $('#input_title').css('border','1px solid red');
     } else if(title.length>=30)
        {
            $('#title').html(`<p style=\\'color:red\\'>Your First name must not Greater then 30 character`);
            $('#input_title').css('border','1px solid red');
     }
        else
        {
         $('#title').html('');
            $('#input_title').css('border','1px solid green');  
        }
        })
        $(document).on('blur','#location',function(){
            const location=$(this).val().trim();
            if(location.length<3)
        {
            $('#error_location').html('<p style=\\'color:red\\'>Your Last name must be Greater then 3 character</p>');
            $('#location').css('border','1px solid red');
        }
        else if(location.length>30)
        {
            $('#error_location').html('<p style=\\'color:red\\'>Your Last name must not Greater then 30 character</p>');
            $('#location').css('border','1px solid red');
        }
        else
        {
            $('#error_location').html('');
            $('#location').css('border','1px solid green');
        }
        })
        $(document).on('blur','#email',function(){
            const description=$(this).val().trim();
            if(description.length<=0)
        {
             $('#error_shop_email').html('<p style=\\'color:red\\'>Email must not empty</p>');
            $('#email').css('border','1px solid red');   
        }
        else if(description.length>40)
        {
             $('#error_shop_email').html('<p style=\\'color:red\\'>Email must not greater then 40 character</p>');
            $('#email').css('border','1px solid red');   
        }
        else
        {
            $('#error_shop_email').html('');
            $('#email').css('border','1px solid green');
             $.ajax({
            url:'update_exist_user.php',
            type:'POST',
            data: $('#user_data').serialize(),
            success:function(response){
                let str = response.trim();
            let word = 'email';
            let index = str.indexOf(word); 
            let email='';  
            if (index !== -1) {
                email= str.substring(index, index + word.length)
            }
             if(email === 'email')
            {
                $('#error_shop_email').html('<p  style=\\'color:red\\'>Email already exist</p>');
                $('#email').css('border','1px solid red');
            }
            else
            {
                $('#error_shop_email').html('');
                $('#email').css('border',''); 
            }

            }
            });
            

        }
        })
            $(document).on('blur','#contact',function(){
            const description=$(this).val().trim();
            if (!/^[0-9]+$/.test(description)) {
        $('#error_shop_contact').html('<p  style=\\'color:red\\'>Only 0-9 Number allowed in Phone number</p>');
        $('#contact').css('border','1px solid red')
        return;
    }else if(description.length!=10)
        {
             $('#error_shop_contact').html('<p style=\\'color:red\\'>contact number must 10 digit </p>');
            $('#contact').css('border','1px solid red');   
            return;
        }
        else if(description.length>10)
        {
             $('#error_shop_contact').html('<p style=\\'color:red\\'>contact number must have 10 degit </p>');
            $('#contact').css('border','1px solid red');   
            return;
        }
        else
        {
            $('#error_shop_contact').html('');
            $('#contact').css('border','1px solid green');
              $.ajax({
            url:'update_exist_user.php',
            type:'POST',
            data: $('#user_data').serialize(),
            success:function(response){
                let str = response.trim();
            let word = 'contact';
            let index = str.indexOf(word);   
            let contact='';
            if (index !== -1) {
                contact = str.substring(index, index + word.length)
            }
             if(contact === 'contact')
            {
                $('#error_shop_contact').html('<p  style=\\'color:red\\'>Contact number alredy exist</p>');
                $('#contact').css('border','1px solid red');
            }
            else
            {
                $('#error_shop_contact').html('');
                $('#contact').css('border',''); 
            }

            }
            });
        }
        })

$(document).on('click','#submit',function(e){
 e.preventDefault();
          const form = document.getElementById('user_data');
         if (!form.checkValidity()) {
            form.reportValidity();
            return;
    }
    const formData = new FormData(form);
    if($('.shop_error').text()!=''){
        $('#shop_errors').html('<p style=\"color:red\">Please Enter valid information</p>')
         window.scrollTo({
                top: 0,
                behavior: 'smooth'
                });
    }
    else
    {
        $('#shop_errors').html('');
        $.ajax({
            url:'update_profile_back.php',
            type:'post',
            data:formData,
            contentType: false, 
    processData: false, 
            success:function(response){
             window.location.href = 'user_desbord.php';
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
        #uif
        {
        width:100px;
        height:100px;
       
}
        #fn{
 font-size:50px;
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
        #container{
            margin:4%;
            background-color: white;
            border-radius:10px;
        }
        body{
        padding-top:90px;
            background-image: url('https://media.istockphoto.com/id/952039286/photo/abstract-background-wallpaper.webp?a=1&b=1&s=612x612&w=0&k=20&c=hFifqkMffTTH6Je1r66_ybhfMY0S8rz3--LJci5_pFk=');
            background-size: cover;
            background-repeat:no-repeat;
        }
        label{
            margin-left:13%;
        }
        .shop_error{
            margin-left:13%;
        }
        #shop_errors{
            text-align: center;
        }
        @media(max-width:576px)
        {
              #show_img{
            height: 1   00px;
            width: 100px;
        }
              #uif
        {
        width:100px;
        height:100px;
       
}
        #fn{
 font-size:20px;
}
}
        @media(max-width:430px){
              #uif
        {
        width:50px;
        height:50px;
       
}
            #show_img{
            height: 100px;
            width: 100px;
        }
        #fn{
 font-size:20px;
}
        }
      
     </style>
</head>
<body>
    <div id='container'>
        <h2 style='text-align: center ;color: orange;text-shadow: 5px 5px 4px rgba(0, 0, 0, 0.6)' id='fn'><img src='download.jpeg' alt='new shop' id='uif'> User Information</h2>
        <div id='shop_errors'></div>
        <form action='user_desbord.php' method='POST' id='user_data' enctype='multipart/form-data'>
            <input  type='text' name='fname' value='". htmlspecialchars($fname, ENT_QUOTES) ."' placeholder='Enter Your First name' class='form-control my-4 w-75 mx-auto' id='input_title' required>
            <div id='title' class='shop_error'></div>
            <div class='container' style='max-width:77%'>
      <input id='location' type='text' value='".htmlspecialchars($lname)."' name='lname' class='form-control' placeholder='Enter your Last name' required>
            <div id='error_location' class='shop_error'></div>
            <input id='email' type='email' value='".htmlspecialchars($email)."' name='email' class='form-control my-4' placeholder='Enter your Email here..' required>
           <div id='error_shop_email' class='shop_error'></div>
           <input id='contact' type='number' value='".htmlspecialchars($contact)."' name='contact' class='form-control my-4' placeholder='Enter your Email here..' required>
           <div id='error_shop_contact' class='shop_error'></div>
           <div class='container' style='max-width:77%' >
            <div><img src='$src_img' alt='' id='show_img'></div>
    <div class='input-group'>
       <input type='file' id='fileInput'  name='fileInput' style='display: none;'>
        <input type='text' id='fileName' value='".htmlspecialchars($src_img)."' name='filename' placeholder='Shop image' class='form-control' required disabled>
       <span class='input-group-text'>

        <button type='button' onclick='document.getElementById(\"fileInput\").click();' class='btn btn-primary' >Upload</button>
      </span>
    </div>
    <div id='error_image' class='shop_error'></div>
  </div>
   <button type='submit' class='btn btn-primary my-4' style='margin-left:40%;width:20%' id='submit'>Submit</button>    
        </form>
    </div>

    <script>
            document.getElementById('fileInput').addEventListener('change', function () {
        const file = this.files[0];
        const preview = document.getElementById('show_img');
        if (file) {
            document.getElementById('fileName').value = file.name;
        }
        const text=file.name;
        const type=['jpg', 'jpeg', 'png','jfif', 'gif', 'webp'];
        const match = text.match(/\.(.*)$/);
        let cnt=0;
        for(i=0;i<type.length;i++)
        {
                    if (match[1]==type[i]) {
                const result = match[1];
                cnt++;
            }
        }
        if(cnt<=0)
        {
            $('#error_image').html('<p style=\\'color:red\\'>Only Image allwos</p>');
            $('#fileName').css('border','1px solid red');
        }
        else
        {
            $('#error_image').html('');
             $('#fileName').css('border', '1px solid green');
               const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
        $('#show_img').show();
        }
    });
    </script>
    <script>
setInterval(() => {
  fetch('update_activity.php');
}, 2000);
</script>
</body>
</html>";

     }
 $conn->close();
?>