<?php
session_start();

if (empty($_SESSION['count'])) {
  $_SESSION['count'] = 0;
}

if (empty($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

if (($key = array_search($_GET['id'], $$_SESSION['cart'])) !== false) {
  unset($cart[$key]);

  if ($_SESSION['count'] > 0) {
    $_SESSION['count']--;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Chakra+Petch" rel="stylesheet">
  <script src="browse.js"></script>
  <title>RetroRama</title>
</head>
<body>
  <?php

  $prods = array
  (
    array("nes","Nintendo Entertainment System (NES)",70),
    array("nesControll","Controller (NES)",10),
    array("excitebike","Excitebike (NES)",15),
    array("snes","Super Nintendo Entertainment System (SNES)",80),
    array("snesControll","Controller (SNES)",20),
    array("donkeykong","Donkey Kong Country (SNES)",20),
    array("n64","Nintendo 64 (N64)",90),
    array("n64Controll","Controller (N64)",15),
    array("mario","Super Mario 64 (N64)",30),
    array("psx","Sony PlayStation (PSX)",75),
    array("psxControll","Controller (PSX)",12),
    array("parappa","PaRappa the Rapper (PSX)",120)
  );
  ?>

  <div class="header">
    <h1>RetroRama</h1>
    <p>For all your classic gaming needs.</p>
  </div>

  <div class="navbar" id="navbar">
    <a class="active" href="#home">Products</a>
    <a href="checkout.html">Checkout</a>
    <div class="navbar-right">
      <?php
      echo "<a id='cart' href='cart.html'>Cart(".$_SESSION['count'].")</a>";
      ?>
    </div>
  </div>

  <div>
    <?php
    echo "Removed ".$prods[$_GET['id']][1]." from the cart!";
    ?>
  </div>
  
  <div>
    <a href="browse.php">Continue Shopping</a>
    <a href="cart.html">View Cart</a>    
  </div>

</body>
</html>
