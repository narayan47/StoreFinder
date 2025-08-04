<?php
include("header.php");    
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
      $(document).ready(function(){
     var width = $(window).width();
    var height = $(window).height();
    if(width<=820)
    {
      $('#shearch_div').hide();
       $('#sh_log').show();
  }
      $.ajax({
      url:'recent.php',
      type:'post',
      success:function(response){
      $('#recent').html(response);
}     
})
$.ajax({
      url:'popular.php',
      type:'post',
      success:function(response){
      $('#popular').html(response);
}     
})
})
    </script>
          <style>
  body, html {
    margin: 0;
    padding: 0;
    height: 100%; 
    padding-top:60px;
  }

  .bg-box {
    width: 90%;
    height: 100%;
    background-image: url('bg_cover.png'); 
    background-size: cover;     
    background-position: center; 
    background-repeat: no-repeat;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    margin-left: 5%;  
  }

  #h2 {
    font-size: 50px;
    text-align: center;
    padding-top: 10%;
  }

  #h5 {
    font-size: 30px;
    text-align: center;
    padding-top: 5px;
  }

  #p {
    font-size: 30px;
    text-align: center;
    padding-top: 5px;
  }

  .shop-card {
    width:17rem;
    margin:0px auto;
  }

  @media (max-width: 1024px) {
   .bg-box {
      height: 60%;
       width: 100%;
       margin-left:0%;
    }
    .shop-card {
      width: 13rem;
       margin-left:-2px;
    }
    #h2 {
      font-size: 55px;
      padding-top: 10%;
    }
    #h5 {
      font-size: 35px;
    }
    #p {
      font-size: 30px;
    }
  }

   @media (max-width: 912px) {
    .bg-box {
      width: 100%;
      height: 40%;
       margin-left:2%;
    }
    #h2 {
      font-size: 50px;
      padding-top: 9%;
    }
    #h5 {
      font-size: 30px;
    }
    #p {
      font-size: 25px;
    }
     .shop-card {
      width: 22rem;
       margin-left:10px;
    }
  }
@media (max-width: 768px) {
 .bg-box {
      height: 50%;
       width: 100%;
    }
    .shop-card {
      width: 20rem;
       margin-left:20px;
    }
}
    @media (max-width: 820px) {
    .bg-box {
      height: 50%;
       width: 100%; 
        margin-left:0%;
    }
    .shop-card {
      width: 20rem;
       margin-left:20px;
    }
  }

  @media (max-width: 480px) {
   #h2 {
      font-size: 33px;
      padding-top: 9%;
    }
    #h5 {
      font-size: 22px;
    }
    #p {
      font-size:20px;
    }
    .shop-card {
      width: 18rem;
      margin-left:30px;
    }
    .bg-box {
      width: 108%;
       margin-left: 1%; 
    } 
  }
    


  @media (max-width: 540px) {
   #h2 {
      font-size: 33px;
      padding-top: 9%;
    }
    #h5 {
      font-size: 22px;
    }
    #p {
      font-size:20px;
    }
    .shop-card {
      width: 21rem;
      margin-left:40px;
    }
    .bg-box {
      width: 108%;
       margin-left: 1%; 
    } 
  }

  @media (max-width: 390px) {
   #h2 {
      font-size: 30px;
      padding-top: 9%;
    }
    #h5 {
      font-size: 20px;
    }
    #p {
      font-size:18px;
    }
    .shop-card {
      width: 18rem;
      margin-left:30px;
    }
    .bg-box {
      width: 108%;
      margin-left: 1%; 
    } 
  }
</style>

</head>
<body>
    <div class='bg-box'>
    <h2 id='h2'>Find Stores Near You, Fast & Easy.</h2>
    <h5  id='h5'>Helping you discover local shops in just a few clicks</h5>
    <p id='p'>No sign-up needed. Just search and explore.</p>
    </div>

    <div class='shadow my-4 mx-4 rounded-3 py-2 col-12 '>
    <h2 id='ref'><i class='bi bi-clock text-success mx-1 px-2 my-3'></i>Recent Added Shops </h2>
   <div id='recent' class='row'>
</div>
    </div>

     <div class='shadow my-4 mx-4 rounded-3 py-2 col-12 '>
    <h2 id='ref'><i class='bi bi-heart-fill text-danger mx-1 px-2 my-3'></i>Popular shops</h2>
   <div id='popular' class='row '>
</div>
    </div>
</body>   
</html>

";
include ("footer.php");

?>