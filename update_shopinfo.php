<?php
session_start();
 if(!isset($_SESSION["id"]))
      {
          header("location:registration.php");
          exit;
      }
   if(isset($_GET["shop"])) 
   {
    $shop_id=$_GET["shop"];
    include("connection.php");
    $shop_data="SELECT * FROM tm_shopinfo where shop_id=$shop_id";
    $shop_result=$conn->query($shop_data);
     if($shop_result->num_rows>0){
        $shop_row=$shop_result->fetch_assoc();
         $title=$shop_row["shop_title"];
            $shop_id=$shop_row["shop_id"];
            $location=$shop_row["shop_location"];
            $image=$shop_row["shop_image"];
             $src_img="uploads/shop_img/{$image}";
             $description=$shop_row["shop_description"];
             $category=$shop_row["shop_category"];
            $Otime=$shop_row["shop_opening_time"];
            $Ctime=$shop_row["shop_closing_time"];
            $weekday=$shop_row["shop_open_days"];
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
            if(title.length<3)
        {
            $('#title').html(`<p style=\\'color:red\\'>Shop Title must Greater then or Equal 3 Character</p>`);
            $('#input_title').css('border','1px solid red');
        }
        else if(title.length>100)
        {
                        $('#title').html('<p style=\\'color:red\\'>Shop Title Length not allowed greater the 100 character</p>');
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
            if(location.length<10)
        {
            $('#error_location').html('<p style=\\'color:red\\'>Your shop address must greater then 10 character</p>');
            $('#location').css('border','1px solid red');
        }
        else
        {
            $('#error_location').html('');
            $('#location').css('border','1px solid green');
        }
        })
        $(document).on('blur','#shop_des',function(){
            const description=$(this).val().trim();
            if(description.length<20)
        {
             $('#error_shop_des').html('<p style=\\'color:red\\'>Shop Description must be Greater then 20 character </p>');
            $('#shop_des').css('border','1px solid red');   
        }
        else if(description.length>=500){
              $('#error_shop_des').html('<p style=\\'color:red\\'>Shop Description not allow Greater then 500 character </p>');
            $('#shop_des').css('border','1px solid red');   
        }
        else
        {
            $('#error_shop_des').html('');
            $('#shop_des').css('border','1px solid green');
        }
        })

$(document).on('click','#submit',function(e){
 e.preventDefault();
          const form = document.getElementById('shop_data');
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
            url:'update_shop.php',
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
        #container{
            margin:4%;
            background-color: white;
            border-radius:10px;
        }
        body{
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
        #show_img{
            height: 500px;
            width: 500px;
        }
        @media(max-width:576px)
        {
              #show_img{
            height: 300px;
            width: 300px;
        }
        }
        @media(max-width:375px)
        {
              #show_img{
            height: 250px;
            width: 250px;
        }
        }
     </style>
</head>
<body>
    <div id='container'>
        <h2 style='text-align: center ;color: orange;text-shadow: 5px 5px 4px rgba(0, 0, 0, 0.6);font-size:50px;'><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5F-8KMK7UHDC_6TV7xBkeKymBIP7EUOcDIg&s' alt='new shop' height='150' width='150'> Shop Information</h2>
        <p style='text-align:center'><b>Note : Please Input Valid Shop Information</b></p>
        <div id='shop_errors'></div>
        <form action='user_desbord.php' method='POST' id='shop_data' enctype='multipart/form-data'>
            <input  type='text' name='shop_title' value='". htmlspecialchars($title, ENT_QUOTES) ."' placeholder='Enter Your Shop Title here' class='form-control my-4 w-75 mx-auto' id='input_title' required>
            <div id='title' class='shop_error'></div>
            <div class='container' style='max-width:77%'>
    <div class='input-group'>
      <span class='input-group-text'>
        <i class='bi bi-geo-alt-fill'></i> 
      </span>
      <input id='location' type='text' value='".htmlspecialchars($location)."' name='location' class='form-control' placeholder='Enter your full address (e.g., House No, Street, City, State, PIN)' required>
    </div>
  </div>
            <div id='error_location' class='shop_error'></div>
            <textarea id='shop_des' name='shop_des' placeholder='Enter Discription here' class='form-control my-4 w-75 mx-auto' required>".htmlspecialchars($description)."</textarea>
           <div id='error_shop_des' class='shop_error'></div>
           <div class='container' style='max-width:77%' >
            <div><img src=$src_img alt='' id='show_img'></div>
    <div class='input-group'>
       <input type='file' id='fileInput'  name='fileInput' style='display: none;'>
        <input type='text' id='fileName' value='".htmlspecialchars($src_img)."' name='filename' placeholder='Shop image' class='form-control' required disabled>
       <span class='input-group-text'>
        <button type='button' onclick='document.getElementById(\"fileInput\").click();' class='btn btn-primary' >Upload</button>
      </span>
    </div>
  </div>
   <div id='error_image' class='shop_error'></div>
            <div class='d-flex align-items-center mb-1 mt-4'>
            <label for='category'>Category: </label>
                        <select name='category' id='category' class='form-control w-50' style='margin-left:20px'>
                        <option value='".htmlspecialchars($category)."'>$category</option>";
                    $qry="SELECT category_name from shop_category order by category_name ASC";
                     $result=$conn->query($qry);
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc()){
            $cat_name=$row["category_name"];
                                        echo"
<option value='$cat_name'>$cat_name</option>
                                        ";
        }
        }


        echo"                </select>
            </div><br>
             <div class='d-flex align-items-center mb-1 mt-4'>
            <label for='weekday'>Shop Open Weekday : </label>
                        <select name='weekday' id='weekday' class='form-control w-25' style='margin-left:20px'>    
                        <option value='".htmlspecialchars($weekday)."'>$weekday</option>
                        <option value='All days'>All days</option>
                        <option value='Monday – Friday'>Monday – Friday</option>
                     <option value='Monday – Saturday'>Monday – Saturday</option>
                    <option value='Monday – Sunday'>Monday – Sunday</option>
                    <option value='Saturday – Sunday'>Saturday – Sunday</option>
                    <option value='Saturday – Monday'>Saturday – Monday</option>
                    <option value='Sunday – Thursday'>Sunday – Thursday</option>
                    <option value='Friday – Sunday'>Friday – Sunday</option>
                    <option value='Wednesday – Sunday'>Wednesday – Sunday</option>
                    <option value='Thursday – Saturday'>Thursday – Saturday</option>
                    <option value='Tuesday – Saturday'>Tuesday – Saturday</option>
                    <option value='Sunday – Monday'>Sunday – Monday</option>
                    <option value='Friday – Monday'>Friday – Monday</option>
                        </select>
            </div><br>
             <p style='margin-left: 13%;'><b>Note : if your shop is 24 hour Open then seat Open time 00:00 And Closing time 00:00</b></p>
<div class='d-flex align-items-center mb-3'>
    <label for='o_time' class='me-4 mb-0'>Opening Time:</label>
    <input name='shop_opentime' type='time' class='form-control w-25' id='o_time' value='".htmlspecialchars($Otime)."' required>
</div>
<div class='d-flex align-items-center mb-3'>
    <label for='c_time' class='me-4 mb-0'>Closing Time:</label>
    <input name='shop_closetime' type='time' class='form-control w-25' id='c_time' value='".$Ctime."' required>
</div>
    <input type='number' value='".htmlspecialchars($shop_id)."' style='display: none;' name='shop_id'>
           <div class='input-group my-5'>
        <span class='input-group-text bg-success my-4 mx-5' style='border-radius:120px;height:50px'>
           <a href='user_desbord.php' style='text-decoration:none;'><i class='bi bi-arrow-left-square fs-5 text-white'> Go Back</i></a>
           </span>
          <button type='submit' class='btn btn-primary my-4' style='margin-left:24%;width:20%' id='submit'>Submit</button>    
          </div>
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
</body>
</html>";

     }
      $conn->close();
    }
    else
    {
        echo "<div>
        <h2 style='text-align:center;margin-top:20%;color:red'>Invaid Shop</h2>
        </div>";
    }

?>