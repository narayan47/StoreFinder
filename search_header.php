<?php
include("connection.php");

$qry = "SELECT category_name FROM shop_category ORDER BY category_name ASC";
$result = $conn->query($qry);

$html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Search</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>

    <script>
    $(document).ready(function () {
        $('#result').hide();
        $('#input').on('keyup', function () {
            const inputValue = $(this).val();
            if (inputValue.length >= 1) {
                $.ajax({
                    url: 'search_result.php',
                    type: 'post',
                    data: $('#search_data').serialize(),
                    success: function (response) {
                        $('#result').html(response).show();
                    }
                });
            } else {
                $('#result').hide();
            }
        });
    });
    </script>

    <style>
        #li { border-radius: 20px; margin-top: 2px; }
        #li:hover { color: red; background-color: yellow; }
        #result {
            overflow-y: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 10px;
            margin-left: 10px;
            margin-right: 10px;
        }
        #search_div {
            max-width: 100%;
            background-color: blue;
            height: 8vh;
        }
        #input {
            margin: 5px auto;
            margin-right: 1%;
            height: 6vh;
        }
        #button {
            margin-right: 1%;
            height: 6vh;
            text-align: center;
            background-color: green;
        }
        #category {
            height: 6vh;
            margin-left: 1%;
            margin-top: 0.9%;
            width: 20%;
        }
        @media (max-width: 1024px) {
            #search_div { height: 7vh; }
            #input, #button, #category { height: 5vh; }
        }
        @media (max-width: 853px) {
            #search_div { height: 4vh; }
            #input, #button, #category { height: 3vh; }
        }
        @media (max-width: 768px) {
            #search_div { height: 5vh; }
            #input, #button, #category { height: 4vh; }
        }
        @media (max-width: 480px) {
            #search_div { height: 7vh; }
            #input, #button, #category { height: 5vh; }
        }
    </style>
</head>
<body>
    <div id='search_div' class='search'>
        <form action='search_shops.php' method='GET' class='input-group mb-3' id='search_data'>
            <select name='category' id='category' class='my-2 mx-1'>
                <option value='All'>All</option>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cat_name = htmlspecialchars($row['category_name'], ENT_QUOTES);
        $html .= "<option value='$cat_name'>$cat_name</option>";
    }
}

$html .= "</select>
            <input type='text' placeholder='Search...' class='form-control my-2' id='input' name='search'>
            <button class='btn btn-light text-dark border rounded-3 my-2' type='submit' id='button'>
                <i class='bi bi-search text-warning' id='sh'></i>
            </button>
        </form>
        <div id='result'></div>
    </div>
</body>
</html>";

return $html;
?>
