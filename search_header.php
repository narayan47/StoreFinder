<?php

return "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Search</title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
     <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
     <script>
       $(document).ready(function() {
       $('#result').hide();
        $('#input').on('keyup',function(){
            const inputValue=$(this).val();
            if(inputValue.length>=1)
            {
            $.ajax({
            url:'search_result.php',
            type:'post',
            data:$('#search_data').serialize(),
            success:function(response)
            {
            $('#result').html(response);
             $('#result').show();
}

});
}
else
{
     $('#result').hide();
}
});
     $('#li').on('click',function(){
})
});



    </script>
    
    <style>
      #li{
    border-radius:20px;
    margin-top:2px;
}
          #li:hover{
    color:red;
    background-color:yellow;
}
     #result {  
  overflow-y: auto;     
  background: white;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 10px;
  margin-left: 10px;
  margin-right: 10px;
}
        #search_div{
            max-width:100%; 
            background-color:blue;
            height: 8vh;

        }
        #input{
            margin:5px auto;
            margin-right:1%;
            height: 6vh;
        }
        #button
        {
           margin-right: 1%;
           height: 6vh;
           text-align:center;
           background-color:green;
        }
        #category{
             height: 6vh;
              margin-left: 1%;
            margin-top: 0.9%;
            width:20%;
        }




@media (max-width: 1024px) {
 #search_div{
            max-width:100%; 
            height: 7vh;

        }
             #input{
            height: 5vh;
        }
        #button
        {
           height: 5vh;
           
        }
        #category{
             height: 5vh;
        }
}

@media (max-width: 853px) {
 #search_div{
            max-width:100%; 
            height: 4vh;

        }
             #input{
            height: 3vh;
        }
        #button
        {
           height: 3vh;
           
        }
        #category{
             height: 3vh;
        }
}
@media (max-width:768px) {
 #search_div{
            max-width:100%; 
            height: 5vh;

        }
             #input{
            height: 4vh;
        }
        #button
        {
           height: 4vh;
           
        }
        #category{
             height: 4vh;
        }
}

@media (max-width: 480px) {
 #search_div{ 
            height: 7vh;

        }
             #input{
            height: 5vh;
        }
        #button
        {
           height: 5vh;
           
        }
        #category{
             height: 5vh;
        }
}


    </style>
</head>
<body>
    <div id='search_div' class='search'>
        <form action='search_shops.php' method='GET' class='input-group mb-3' id='search_data'>
        <select name='category' id='category' class='my-2 mx-1'>
                <option value='All'>All</option>
                 <option value='Accessories Repair'>Accessories Repair</option>
                    <option value='Automobile Accessories'>Automobile Accessories</option>
                    <option value='Bakery'>Bakery</option>
                    <option value='Books'>Books</option>
                    <option value='Clothing & Apparel'>Clothing & Apparel</option>
                    <option value='Cosmetics & Beauty'>Cosmetics & Beauty</option>
                    <option value='Electronics'>Electronics</option>
                    <option value='Fashion Combo Shop'>Fashion Combo Shop</option>
                    <option value='Footwear'>Footwear</option>
                    <option value='Furniture'>Furniture</option>
                    <option value='Gift & Handicrafts'>Gift & Handicrafts</option>
                    <option value='Grocery'>Grocery</option>
                    <option value='Hardware & Tools'>Hardware & Tools</option>
                    <option value='Home Decor'>Home Decor</option>
                    <option value='Jewelry'>Jewelry</option>
                    <option value='Kitchenware'>Kitchenware</option>
                    <option value='Mobile & Accessories'>Mobile & Accessories</option>
                    <option value='Pet Supplies'>Pet Supplies</option>
                    <option value='Pharmacy'>Pharmacy</option>
                    <option value='Sports & Fitness'>Sports & Fitness</option>
                    <option value='Stationery'>Stationery</option>
                    <option value='Toys & Games'>Toys & Games</option>
                        </select>
                         <input type='text' placeholder='Search...' class='form-control my-2' id='input' name='search'>
    <button class='btn btn-light text-dark border rounded-3 my-2' type='submit' id='button'><i class='bi bi-search text-warning' id='sh'></i>
  </button>
  </form>
   <div id='result'>
    </div>
    </div>
</body>
</html>";


?>