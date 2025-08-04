<?php

return "

<div id='shearch_divs' class='my-2 mx-2'>
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
   <div id='res'>
    </div>
    </div>
    </div>";


?>