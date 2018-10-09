<?php
session_start();

if (empty($_SESSION['count'])) {
  $_SESSION['count'] = 0;
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
    <a href="checkout.php">Checkout</a>
    <div class="navbar-right">
      <?php
      echo "<a id='cart' href='cart.php'>Cart(".$_SESSION['count'].")</a>";
      ?>
    </div>
  </div>

  <div>
    <ul>
      <li>
        <?php
        for ($x = 0; $x < count($prods); $x++) {
          echo "<li>\n";
          echo "<img src='images/".$prods[$x][0].".jpg'/>\n";
          echo "<h2>".$prods[$x][1]."</h2>\n";
          echo "<h3>$".$prods[$x][2]."</h3>\n";
          echo "<p>\n";
          if ( in_array($x, $_SESSION['cart']) ) {
            echo "<a href='removeFromCart.php?id=".$x."'>Remove from Cart</a>";
          }
          else {
            echo "<a href='addToCart.php?id=".$x."'>Add to Cart</a>";
          }
          
          // echo "<input id='".$prods[$x][0]."' type='number' name='quantity' min='1' max='10' value='1'>\n";
          // echo "<button type='button' onclick='addItem(document.getElementById(\"".$prods[$x][0]."\").value)'>Add to Cart</button>\n";
          echo "</p>\n";
          echo "</li>\n";
        }
        ?>
      </ul>
    </div>

  </body>
  </html>
