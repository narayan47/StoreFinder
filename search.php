<?php

$html="

<div id='shearch_divs' class='my-2 mx-2'>
    <div id='search_div' class='search'>
        <form action='search_shops.php' method='GET' class='input-group mb-3' id='search_data'>
        <select name='category' id='category' class='my-2 mx-1'>
                <option value='All'>All</option>
                 <option value='Accessories Repair'>Accessories Repair</option>";
                    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cat_name = htmlspecialchars($row['category_name'], ENT_QUOTES);
        $html .= "<option value='$cat_name'>$cat_name</option>";
    }
}
                     $html.="  </select>
                         <input type='text' placeholder='Search...' class='form-control my-2' id='input' name='search'>
    <button class='btn btn-light text-dark border rounded-3 my-2' type='submit' id='button'><i class='bi bi-search text-warning' id='sh'></i>
  </button>
  </form>
   <div id='res'>
    </div>
    </div>
    </div>";

    return  $html;

?>