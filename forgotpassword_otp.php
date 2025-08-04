<?php
session_start();
include("loginhead.php");   
$minutes = 5;
$seconds = $minutes * 60;
$otp="1";
echo"
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Store Finder</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q' crossorigin='anonymous'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script>
$(document).ready(function(){
const nav = performance.getEntriesByType('navigation')[0];
  if (nav && nav.type === 'reload') {
     window.location.href='Forgotpassword.php';
  }

let total = $seconds;
  $('.otp-input').first().focus();
$(document).on('click','#reset',function(){
 $.ajax({
            url:'forgotpass.php',
            type:'POST',
            success:function(response){
}
});
$('.otp-input').val('');
 $('.otp-input').first().focus();
 $('#ld_otp').html(`<span style='color:red'></span>`);
 total = $seconds;
  document.getElementById('tm').innerHTML=document.getElementById('tm').innerHTML = `<p id='tm'>⏱ OTP expires in <b id='seconds'></b> seconds</p>`;
  document.getElementById('reset').style.display = 'none';  
  const countdown = setInterval(() => {
    let mins = Math.floor(total / 60);
    let secs = total % 60;
   document.getElementById('seconds').innerText =(mins + ':' + (secs < 10 ? '0' + secs : secs));
    total--;
    if (total < 0) {
      clearInterval(countdown);
      document.getElementById('tm').innerHTML = `<span style='color:red'>Time out</span>`;
        document.getElementById('reset').style.display = 'block';
    }
  }, 1000);
});

$('.otp-input').on('input', function () {
    const thist = $(this);
    const value = thist.val();
    if (!/^[0-9]$/.test(value)) {
      thist.val('');
      return;
    }
    thist.next('.otp-input').focus();
  });

  $('.otp-input').on('keydown', function (e) {
    if (e.key === 'Backspace' && $(this).val() === '') {
      $(this).prev('.otp-input').focus();
    }
  });

  $('.otp-input').on('focus', function () {
    $(this).select();
  });

  document.getElementById('reset').style.display = 'none';  
  const countdown = setInterval(() => {
    let mins = Math.floor(total / 60);
    let secs = total % 60;
   document.getElementById('seconds').innerText =(mins + ':' + (secs < 10 ? '0' + secs : secs));
    total--;
    if (total < 0) {
      clearInterval(countdown);
      document.getElementById('tm').innerHTML = `<span style='color:red'>Time out</span>`;
        document.getElementById('reset').style.display = 'block';
    }
  }, 1000);";

 if(isset($_SESSION['otp']))
{
  $otp=$_SESSION['otp'];
}



echo"
$(document).on('click','#verify',function(e)
{
   e.preventDefault(); 
   let otp = '';
$('.otp-input').each(function() {
  if($(this).val()=='')
{
   $('#ld_otp').html(`<span style='color:red'>Invalid OTP</span>`);
}
else
{
       $('#ld_otp').html(`<span style='color:red'></span>`);
       otp += $(this).val();
}
});
 if (total < 0) {
  $('#ld_otp').html(`<span style='color:red'>Invalid OTP</span>`);
}else
{
    console.log(total);
     if($otp==otp)
     {
     window.location.href='Resetpassword.php';
    }
     else
     {
      $('#ld_otp').html(`<span style='color:red'>Invalid OTP</span>`);
    }
}



});


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
.otp-input {
  width: 45px;
  height: 45px;
  text-align: center;
  font-size: 24px;
  border: 1px solid #ccc;
  border-radius: 6px;
}
     
     
    </style>
</head>
<body style='padding-top: 100px;'>
    <div class='shadow rounded-3 py-5' id='container'>
    <div class='d-flex justify-content-center'>
<img src='verify.avif' alt='' height='150' width='150'>
</div>
<div class='d-flex justify-content-center my-3'>
<h4>Enter OTP Code </h4>
</div>
             
        <div class='otp-box d-flex gap-1 justify-content-center'>
  <input type='text' class='otp-input' maxlength='1'>
  <input type='text' class='otp-input' maxlength='1'>
  <input type='text' class='otp-input' maxlength='1'>
  <input type='text' class='otp-input' maxlength='1'>
  <input type='text' class='otp-input' maxlength='1'>
  <input type='text' class='otp-input' maxlength='1'>
</div>
 <div class='d-flex justify-content-center my-3'>
      <span id='ld_otp' class='error'></span>
</div>

         <button type='submit' class='btn  btn-primary my-4' id='verify'>Verify OTP</button>
         <div class='d-flex justify-content-center my-3'>
<p id='tm'>⏱ OTP expires in <b id='seconds'></b> seconds </p>
</div>
  <div class='d-flex justify-content-center my-3'>
        <button type='button' class='btn  btn-success btn-sm my-4' id='reset'>Reset OTP</button>
</div>
    </div>
    
</body>
</html>
";
?>