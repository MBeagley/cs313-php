<?php
session_start();

if (empty($_SESSION['count'])) {
  $_SESSION['count'] = 0;
}

if (empty($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
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
    <a href="browse.php">Products</a>
    <a href="checkout.php">Checkout</a>
    <div class="navbar-right">
      <?php
      echo "<a class='active' id='cart' href='cart.php'>Cart(".$_SESSION['count'].")</a>";
      ?>
    </div>
  </div>

  <h2>Your Cart:</h2>

  <div>
    <ul>
      <li>
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $x) {
          echo "<li>\n";
          echo "<img src='images/".$prods[$x][0].".jpg'/>\n";
          echo "<h2>".$prods[$x][1]."</h2>\n";
          echo "<h3>$".$prods[$x][2]."</h3>\n";
          $total = $total + $prods[$x][2];
          echo "<p>\n";
          echo "<a class='buttonlink' href='removeFromCart.php?id=".$x."'>Remove from Cart</a>";
          
          // echo "<input id='".$prods[$x][0]."' type='number' name='quantity' min='1' max='10' value='1'>\n";
          // echo "<button type='button' onclick='addItem(document.getElementById(\"".$prods[$x][0]."\").value)'>Add to Cart</button>\n";
          echo "</p>\n";
          echo "</li>\n";
        }
        ?>
      </ul>
    </div>

    <div>
      <?php
      echo "<h2>Total:</h2>";
      echo "<h3>$".$total."</h3>";
      ?>

      <a class='buttonlink' href="checkout.php">Go to Checkout</a>
    </div>
  </body>
  </html>
