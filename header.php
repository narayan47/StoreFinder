<?php
session_start();
if (isset($_SESSION["email"]))
{
  unset($_SESSION["email"]);
}
include("connection.php");
$search_head=include("search_header.php");
$search=include("search.php");
if(isset($_SESSION["id"]))
{
  $id=(int)$_SESSION["id"];
  $sql="SELECT profile_img from tm_user where user_id=$id";
  $result=$conn->query($sql);
  if($result->num_rows > 0)
  {
    $row=$result->fetch_assoc();
    $img=$row["profile_img"];
  }


echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Store Finder</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q' crossorigin='anonymous'></script>
   <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
        <script>
      $(document).ready(function() {
      $('#shearch_divs').hide();
     $('#sh_log').hide();
     var width = $(window).width();
    var height = $(window).height();
    if(width<=1024)
    {
      $('#shearch_div').hide();
       $('#sh_log').show();
  }
        $(document).on('click','#sh_log',function(){
        $('#shearch_divs').toggle();
        $('#sx').toggleClass('bi bi-x text-danger fs-2');
});
  $('#res').hide();
   $(document).on('keyup', '#input', function () {
    const inputValue = $(this).val();
    if (inputValue.length >= 1) {
        $.ajax({
            url: 'search_result.php',
            type: 'post',
            data: $('#search_data').serialize(),
            success: function (response) {
                $('#res').html(response).show();
            }
        });
    } else {
        $('#res').hide();
    }
});
     $('#li').on('click',function(){
})
  const path = window.location.pathname;
console.log(path)
  if (path.includes('/StoreFinder/index.php')) {
    $('#home').addClass('active');
  } else if (path.includes('/StoreFinder/aboutus.php')) {
    $('#about').addClass('active');
  }
});
     </script>
    <style>
      #search_divs{
            max-width:100%; 
            background-color:blue;

        }
 #res {
  position: absolute; 
  z-index: 9999;       
  overflow-y: auto;   
  background: white;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 10px;
  margin-left: 10px;
  margin-right: 10px;
  color: white;      
}

 #li{
    border-radius:20px;
    margin-top:2px;
}
          #li:hover{
    color:red;
    background-color:yellow;
}

        .active {
  color: red !important;
  font-weight: bold;
}
        nav{
            background-color:white;
        }
        #img
        {
        border-radius:50%;
         height:40%;
          width:40%;
          margin-left:5%;
}
          #home{
          text-decoration:none;
          font-size:20px;
          color:black;
          margin-left:-30%;
          }
          #logout{
        text-decoration:none;
        font-size:20px;
        color:black;
        margin-left:-5%;
        
} 
      .aboutus{
        text-decoration:none;
        font-size:20px;
        color:black;
        margin-left:-5%;
}
        .hover:hover{
  background-color:yellow;
  color:red;
}
   #logout:hover{
 background-color:yellow;
  color:red;
}
   #a_logo{
   margin-left:15px;
   width:30%;
}
   #about:hover{
 background-color:yellow;
  color:red;
}
   #home:hover{
 background-color:yellow;
  color:red;
}
        @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css');
        #logo{
     border-radius: 40vh;
      width:25%;
     height:20%;
}

      @media (max-width: 576px) {
   #img
        {
        border-radius:50%;
         height:100%;
          width:100%; 
          margin-left:-6px;
}
          
          #home{
          text-decoration:none;
          font-size:17px;}
          #logout{
        text-decoration:none;
        font-size:17px;
} 
      .aboutus{
        text-decoration:none;
        font-size:19px;
}
        #logo{
     border-radius: 20vh;
     margin-left:-7px;
      
}
     #a_logo{
    width:15%;
}
  
}
 @media (max-width: 768px) {
#logo{
     margin-left:-16px;
     width:37%;
     height:50%;
      
}
      #img
        {
         height:70%;
          width:60%; 
          margin-left:-6px;
}
}
 @media (max-width: 820px) {
#logo{
     margin-left:-16px;
     width:39%;
     height:50%;
      
}
      #img
        {
         height:50%;
          width:50%; 
          margin-left:-6px;
}

}
 @media (max-width: 540px) {
#logo{
     margin-left:-16px;
     width:40%;
     height:50%;
      
}
      #a_logo{
    width:40%;
}
      #img
        {
         height:50%;
          width:50%; 
          margin-left:-6px;
}
          #home{
          font-size:17px;
          margin-left:-40%}
          #logout{
        text-decoration:none;
        font-size:17px;
} 

}

 @media (max-width: 1024px) {
 #res {
width:90%;
}
#logo{
     margin-left:-16px;
     width:30%;
     height:50%;
      
}
      #img
        {
         height:50%;
          width:40%; 
          margin-left:-6px;
}

}
   @media (max-width: 375px) {
   #img
        {
        border-radius:50%;
         height:70%;
          width:70%; 
          margin-left:-6px;
}
          
          #home{
          text-decoration:none;
          font-size:14px;
          margin-left:-50px}
          #logout{
        text-decoration:none;
        font-size:14px;
} 
      .aboutus{
        text-decoration:none;
        font-size:14px;
}
        #logo{
     border-radius: 20vh;
     margin-left:-30px;
     width:120%;
     height:70%;
      
}
     #a_logo{
    width:15%;
}
  
} 
 @media (max-width: 430px) {
   #img
        {
        border-radius:50%;
         height:60%;
          width:60%; 
          margin-left:-2px;
}
          
          #home{
          text-decoration:none;
          font-size:11px;
          margin-left:-55px
          }
          #logout{
        text-decoration:none;
        font-size:11px;
        margin-left:2px;  
} 
      .aboutus{
        text-decoration:none;
        font-size:11px;
         margin-left:2px;
}

        #logo{
     border-radius: 20vh;
     margin-left:-18px;
     width:100%;
     height:10%;
      
}
     #a_logo{
    width:12%;
}
  
} 

 @media (max-width:414px) {
   #img
        {
        border-radius:50%;
         height:60%;
          width:60%; 
          margin-left:-2px;
}
          
          #home{
          text-decoration:none;
          font-size:8px;
          margin-left:-50px;
          }
          #logout{
        text-decoration:none;
        font-size:8px;
        margin-left:-2px;  
} 
      .aboutus{
        text-decoration:none;
        font-size:8px;
         margin-left:2px;
}
        #logo{
     border-radius: 20vh;
     margin-left:-18px;
     width:100%;
     height:10%;
      
}
     #a_logo{
    width:12%;
}
  
} 


 @media (max-width:768px) {
   #img
        {
        border-radius:50%;
         height:60%;
          width:60%; 
          margin-left:-2px;
}
          
          #home{
          text-decoration:none;
          font-size:14px;
          margin-left:-55px
          }
          #logout{
        text-decoration:none;
        font-size:14px;
        margin-left:2px;  
} 
      .aboutus{
        text-decoration:none;
        font-size:14px;
         margin-left:2px;
}
      
        #logo{
     border-radius: 20vh;
     margin-left:-18px;
     width:100%;
     height:10%;
      
}
     #a_logo{
    width:12%;
}
  
} 
</style>
</head>
<body>
<div class='fixed-top'>
    <nav class='navbar bg-s shadow'>
    <a class='navbar-brand' href='http://localhost/StoreFinder/index.php' id='a_logo'>
      <img src='sotefinderlogo.jpg' alt='StoreFinder' id='logo'>
    </a>
    <a href='http://localhost/StoreFinder/index.php'  id='home'>Home</a>
    <a href='aboutus.php' class='aboutus' id='about' >AboutUs</a>
    <a href='new_shopinfo.php' title='Create' class='aboutus'><i class='bi bi-plus-circle'></i></a>
    <a href='logout.php'  id='logout'>LogOut</a>
    <div id='shearch_div'>$search_head</div>
    <div id='sh_log'><button style='border:none;background:none'><i class='bi bi-search text-success' id='sx'></i></button></div>
    <a href='user_desbord.php' style='width:10%'><input type='image' id='img' src='uploads/profile/$img' alt='' ></a>
    </nav>
    <div id='shearch_divs' class='my-2 mx-2'>$search</div>
    </div>
</body>
</html>";
}
else
{
  echo "
<!DOCTYPE html>
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
     $(document).ready(function() {
      $('#shearch_divs').hide();
     $('#sh_log').hide();
     var width = $(window).width();
    var height = $(window).height();
    if(width<=1024)
    {
      $('#shearch_div').hide();
       $('#sh_log').show();
  }
        $(document).on('click','#sh_log',function(){
        $('#shearch_divs').toggle();
          $('#sx').toggleClass('bi bi-x text-danger fs-2');
});
  $('#res').hide();
   $(document).on('keyup', '#input', function () {
    const inputValue = $(this).val();
    if (inputValue.length >= 1) {
        $.ajax({
            url: 'search_result.php',
            type: 'post',
            data: $('#search_data').serialize(),
            success: function (response) {
                $('#res').html(response).show();
            }
        });
    } else {
        $('#res').hide();
    }
});
     $('#li').on('click',function(){
})
  const path = window.location.pathname;
console.log(path)
  if (path.includes('/StoreFinder/index.php')) {
    $('#home').addClass('active');
  } else if (path.includes('/StoreFinder/aboutus.php')) {
    $('#aboutus').addClass('active');
  }
});
     </script>
    <style>
      #search_divs{
            max-width:100%; 
            background-color:blue;

        }
   #res {
  position: absolute; 
  z-index: 9999;       
  overflow-y: auto;   
  background: white;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 10px;
  margin-left: 10px;
  margin-right: 10px;
  color: white;      
}

 #li{
    border-radius:20px;
    margin-top:2px;
}
          #li:hover{
    color:red;
    background-color:yellow;
}
        nav{
            background-color:white;
        }
             nav{
            background-color:white;
        }
        #img
        {
        border-radius:50%;
         height:40%;
          width:30%;
          margin-left:10%;
}
          #home{
          text-decoration:none;
          font-size:20px;
          color:black;} 
          #login{
        text-decoration:none;
        font-size:20px;
        color:black;
} 
        .active {
  color: red !important;
  font-weight: bold;
}
        #aboutus:hover{
  background-color:yellow;
  color:red;
}
  #login:hover{
 background-color:yellow;
  color:red;
}
   #home:hover{
 background-color:yellow;
  color:red;
}
      #aboutus{
        text-decoration:none;
        font-size:20px;
        color:black;
}

 #create{
        text-decoration:none;
        font-size:20px;
        color:black;
}
      @media (max-width: 576px) {
          #home{
          text-decoration:none;
          font-size:20px;
          margin-left:20px;
          color:black;}
          #login{
        text-decoration:none;
        font-size:22px;
} 
      #aboutus{
        text-decoration:none;
        font-size:20px;
      
}
          #create{
        text-decoration:none;
        font-size:20px;
        color:black;
      
}
           #logo{
     border-radius: 20vh;
     margin-left:-9px;
      
}
     #a_logo{
    width:10%;
}
}
 @media (max-width:430px) {
          #home{
          text-decoration:none;
          font-size:20px;
          margin-left:5px;
          color:black;}
          #login{
        text-decoration:none;
        font-size:20px;
} 
      #aboutus{
        text-decoration:none; 
        font-size:20px;
      
}
          #create{
        text-decoration:none;
        font-size:20px;
        color:black;
      
}
           #logo{
     border-radius: 20vh;
     margin-left:-9px;
      
}
     #a_logo{
    width:15%;
}
}
    </style>
</head>
<body>
 <div class='fixed-top'>
    <nav class='navbar bg-s shadow'>
  <div class='container'>
    <a class='navbar-brand' href='http://localhost/StoreFinder/index.php' id='a_logo'>
      <img src='sotefinderlogo.jpg' alt='StoreFinder' width='120' height='70' id='logo'></a>
    <a href='http://localhost/StoreFinder/index.php' id='home' class='hover'>Home</a>
    <a href='registration.php' id='login'>Login</a>
    <a href='registration.php' title='Create' id='create'><i class='bi bi-plus-circle'></i></a>
    <a href='aboutus.php' id='aboutus' >AboutUs</a>
    <div id='shearch_div'>$search_head</div>
    <div id='sh_log'><button style='border:none;background:none'><i class='bi bi-search text-success' id='sx'></i></button></div>
  </div>
    </nav>
    <div id='shearch_divs' class='my-2 mx-2'>$search</div>
    </div>
</body>
</html>";
}

 $conn->close();
?>