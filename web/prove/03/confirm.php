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

  <div>
    <h2>Shipping Address:</h2>
    <?php
    echo "<p>".$_POST["firstname"]." ".$_POST["lastname"]."</p>\n";
    echo "<p>".$_POST["address"]."</p>\n";
    echo "<p>".$_POST["city"].", ".$_POST["state"]." ".$_POST["zip"]."</p>\n";
    ?>
  </div>

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
          echo "</li>\n";
        }
        session_destroy();
        ?>
      </ul>
    </div>

    <div>
      <?php
      echo "<h2>Total:</h2>";
      echo "<h3>$".$total."</h3>";
      ?>
    </div>

  </body>
  </html>
