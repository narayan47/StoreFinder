<?php
include("header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - Store Finder</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q' crossorigin='anonymous'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'>
    <link rel='icon' type='image/png' href='favicons.png' >
<script>
setInterval(() => {
  fetch('update_activity.php');
}, 2000);
</script>
</head>
<body style="padding-top: 130px;">
<?php 
echo "
<header class='bg-dark text-white py-4' style='margin-top:5px'>
  <div class='container text-center'>
    <h1>About Store Finder</h1>
    <p class='lead'>Helping You Discover and Promote Local Stores</p>
  </div>
</header>

<!-- Main Content -->
<main class='container my-5 pb-5'>
  <div class='row justify-content-center'>
    <div class='col-lg-8'>
      <h2>What is Store Finder?</h2>
      <p>
        <strong>Store Finder</strong> is an online platform designed to make it easy for users to find nearby stores based on location or category — and for shopkeepers to promote their businesses online.
      </p>

      <h2>For Customers</h2>
      <ul>
        <li>🔎 Search for stores near your location by name or category</li>
        <li>⭐ View store details, reviews, and contact information</li>
        <li>📍 Discover hidden local stores and essential services</li>
      </ul>

      <h2>For Shopkeepers</h2>
      <ul>
        <li>📝 Register your shop and create a profile</li>
        <li>📷 Upload images, add descriptions, and manage your listing</li>
        <li>📊 Reach more local customers and grow your visibility</li>
      </ul>

      <h2>Our Mission</h2>
      <p>
        We aim to connect local buyers with nearby sellers and empower small businesses by providing a simple and effective digital presence.
      </p>

      <h2>Contact Us</h2>
      <p class='mb-5'>
        Got questions or feedback? Reach out to us anytime!<br />
        📧 Email: <a href='mailto:support@storefinder.com'>storefinder.dev@gmail.com</a>
      </p>
    </div>
  </div>
</main>
";
include("footer.php");
?>
</body>
</html>
